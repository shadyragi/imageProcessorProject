@extends('layouts.app')

@section('content')

<a href="/add" class="btn btn-success col-3 col-md-3">Add New Record</a>

@if(count($images) > 0)
<table class="table">
	<thead>
		<tr>
		<th>title</th>
		<th>image</th>
		</tr>
	</thead>

	<tbody>
		@foreach($images as $img)
		<tr>
		<td>{{$img->title}}</td>
		<td><img src="{{$img->image_path}}" class="rounded" style="width: 100px; height: 100px;"></td>

		<td><a href="/edit/{{$img->id}}" class="btn btn-success">Edit</a></td>

		<form action="/delete/{{$img->id}}" method="POST">
			@csrf
		<td><button  class="btn btn-danger">Delete</button></td>
	</form>

	</tr>
		@endforeach
	</tbody>
</table>
@else

<h3>No Records added yet</h3>
@endif