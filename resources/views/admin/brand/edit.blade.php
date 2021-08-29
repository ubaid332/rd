@extends('admin/layout')
@section('page_title','Edit Brand')
@section('brand_select','active')
@section('container')
<div class="row">
<div class="col-lg-12">

 
 
<div class="card">

<div class="card-body">
    <div class="card-title">
        <h3 class="text-center title-2">Edit Brand</h3>
    </div>
    <hr>
    <form action="{{route('brand.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name" class="control-label mb-1">Brand Name</label>
            <input id="name" value="{{$name}}" name="name" type="text" class="form-control">
        </div>
        @error('name')
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
				@if($image!='')
				 <img width="100px" src="{{asset('public/uploads/'.$image)}}"/>
			  @endif
				<label for="image" class="control-label mb-1">Select Image</label>
				<input id="image" name="image" type="file" class="form-control">
			</div>
		
        
            <div class="form-group">
                <label for="image" class="control-label mb-1"> Show in Home Page</label>
                <input id="is_home" name="is_home" type="checkbox" style="margin-top:40px;"{{$is_home_selected}}>
            </div>
    
        <div>
            <input type="hidden" name="brand_id" value="{{$brand_id}}">
            <button type="submit" class="btn btn-info">Save Record</button>
        </div>
    </form>
</div>
</div>
 
	</div>
</div>

@endsection