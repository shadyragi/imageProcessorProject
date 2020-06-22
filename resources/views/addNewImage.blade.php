@extends('layouts.app')

@section('content')

	
	<div class="container">
		<h2>add new image</h2>
	<form action="{{url('/store')}}" method="POST" enctype="multipart/form-data">
		@csrf
		<div class="form-group col-6 col-md-4">
			<input type="text" name="title" placeholder="title" class="form-control">
		</div>
		<div class="form-group col-6 col-md-4">
			<input type="file" name="image"  class="form-control-file">
		</div>
			<div class="form-group col-6 col-md-4">
					<input type="submit" name="submit" value="Add Image" class="btn btn-success">
				</div>

		</div>
	</form>

	@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

</div>
