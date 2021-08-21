@extends('admin/layout')
@section('page_title','Create Brand')
@section('brand_select','active')
@section('container')
<div class="row">
<div class="col-lg-12">

 
 
<div class="card">

<div class="card-body">
    <div class="card-title">
        <h3 class="text-center title-2">Create Brand</h3>
    </div>
    <hr>
    <form action="{{route('brand.save')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title" class="control-label mb-1">Brand Title</label>
            <input id="title" name="title" type="text" class="form-control">
        </div>
        @error('title')
        <div class="alert alert-danger">
            {{$message}}
        </div>
        @enderror
		
			@error('image')
		<div class="alert alert-danger" role="alert">
			{{$message}}
		</div>
		@enderror	
			<div class="form-group">
				<label for="image" class="control-label mb-1">Select Image</label>
				<input id="image" name="image" type="file" class="form-control">
			</div>
            
        <div class="form-group">
            <label for="code" class="control-label mb-1">Brand Code</label>
            <input id="code" name="code" type="text" class="form-control">
        </div>
       @error('code')
        <div class="alert alert-danger">
       code     {{$message}}
        </div>
        @enderror

        <div class="form-group">
            <label for="value" class="control-label mb-1">Brand Value</label>
            <input id="value" name="value" type="text" class="form-control">
        </div>
        @error('value')
        <div class="alert alert-danger">
            {{$message}}
        </div>
        @enderror

        <div>
            <button type="submit" class="btn btn-info">Save Record</button>
        </div>
    </form>
</div>
</div>
 
	</div>
</div>

@endsection