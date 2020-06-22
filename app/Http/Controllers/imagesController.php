<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\image;

use ImageProcessor;

class imagesController extends Controller
{
    //

	public function index(Request $request) {

		$images = image::all();

		return view("index", ["images" => $images]);
	}

    public function add(Request $request) {

    	return view("addNewImage");

       }

       public function store(Request $request) {

       	$request->validate([
    		'title' => 'required',
    	    'image' => 'required',
			]);

       	$title = $request->title;

       	$img   = image::create(["title" => $title]);


       	if(!file_exists("images")) {

       		$this->makeDirectories();
       	}

       	$imageUploadedPath = (String)$request->file("image")->move("images", $img->id . "." . $request->file("image")->extension());

       	$img->image_path = $imageUploadedPath;

       	$img->save();

       	$newImageFileName = substr($img->image_path, strrpos($img->image_path, "/") + 1);

       	$resizedImage1 = ImageProcessor::make($img->image_path)->resize(300, 300);

       	$resizedImage2 = ImageProcessor::make($img->image_path)->resize(300, 400);

       	$resizedImage3 = ImageProcessor::make($img->image_path)->resize(400, 300);


      	$resizedImage1->save("size 1/" . $newImageFileName);

      	$resizedImage2->save("size 2/" . $newImageFileName);

      	$resizedImage3->save("size 3/" . $newImageFileName);

       	return redirect("/index");
      }

      public function edit(image $image) {

      	return view("updateImage", ["image" => $image]);

      }

      public function update(image $image, Request $request) {

      	$image->title = $request->title;

      	if($request->hasFile("image")) {

      		unlink($image->image_path);

      	 $imageUploadedPath = (String)$request->file("image")->move("images", $image->id . "." . $request->file("image")->extension());

      	 $image->image_path = $imageUploadedPath;
      	}

       	

       	$image->save();

       	return redirect("/index");
      }

      public function delete(image $image) {

      	unlink($image->image_path);

      	$image->delete();

      	return back();
      }

      public function cropAndSave(Request $request) {

      	  $image = image::findOrFail($request->imageId);

      	  $path = $image->image_path;

      	  $extension = substr($path, strrpos($path, ".") + 1);

      	  $img_r = null;


      	  if($extension == "png") {

      	  	$img_r = imagecreatefrompng($request->img);
      	  
      	  } else if($extension == "jpg" || $extension == "jpeg") {

      	  $img_r = imagecreatefromjpeg($request->img);

      	  }

  		  $dst_r = ImageCreateTrueColor( $request->w, $request->h );
 
  		  imagecopyresampled($dst_r, $img_r, 0, 0, $request->x, $request->y, $request->w, $request->h, $request->w,$request->h);
  
 		  header('Content-type: image/jpeg');

  		  imagejpeg($dst_r, $path);

  		  	imagedestroy($dst_r);



      }

      public function makeDirectories() {

      	mkdir("images");

      	mkdir("size 1");

      	mkdir("size 2");

      	mkdir("size 3");
      }
}
