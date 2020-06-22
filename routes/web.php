<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("/index", "imagesController@index");

Route::get("/add", "imagesController@add");

Route::get("/edit/{image}", "imagesController@edit")->name("edit");

Route::post("/update/{image}", "imagesController@update");

Route::post("/store", "imagesController@store");

Route::post("/delete/{image}", "imagesController@delete");

Route::get("/cropAndSave", "imagesController@cropAndSave");
