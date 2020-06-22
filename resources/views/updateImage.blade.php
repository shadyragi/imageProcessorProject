@extends('layouts.app')

@section('content')
	
            <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.Jcrop.min.css') }}" >
    
	
	<div class="container">
		<h2>update image</h2>	
		
	<form action="/update/{{$image->id}}" method="POST" enctype="multipart/form-data">
		@csrf
		<div class="form-group col-6 col-md-4">
			<input type="text" name="title" value="{{$image->title}}" placeholder="title" class="form-control">
		</div>
		<div class="form-group col-6 col-md-4">
			
			<img src="{{asset($image->image_path)}}" path="{{$image->image_path}}" id="cropbox" class="img">
		</div>

		 <div id="btn" class="form-group col-6 col-md-4">
        <input type='button' id="crop" value='CROP' class="btn btn-success" style="visibility: hidden;" class="form-control">
    </div>
		<div class="form-group col-6 col-md-4">
			<input type="file" name="image"  class="form-control-file">
		</div>
			<div class="form-group col-6 col-md-4">
					<input type="submit" name="submit" value="update Image" class="btn btn-success">
				</div>

	 <div>
        <img src="#" id="cropped_img" style="display: none;">
    </div>

		</div>
	</form>

</div>

@section('scripts')

<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
         <script src="{{asset('js/jcrop.js')}}"></script>

<script>
 $(document).ready(function(){
        var size;
        $('#cropbox').Jcrop({
          aspectRatio: 1,
          onSelect: function(c){
           size = {x:c.x,y:c.y,w:c.w,h:c.h};
           $("#crop").css("visibility", "visible");     
          }
        });
      
        $("#crop").click(function(){
            var img = $("#cropbox").attr('path');

            var imageId = <?= $image->id ?>;

            $.ajax({
            	url: "http://localhost:8000/cropAndSave",
          		
          		method: "get",

          		data: {
          	    "x": size.x,
            	"y": size.y,
            	"w": size.w,
            	"h": size.h,
            	"img": img,
            	"imageId": imageId
          		},

          		success: function() {

          			location.reload();
          		}
            });

        });
  });
</script>
