@extends('admin/layout')
@section('page_title','Create Home_Banner')
@section('container')
<div class="row">
<div class="col-lg-12">

 
 
<div class="card">

<div class="card-body">
    <div class="card-title">
        <h3 class="text-center title-2">Create Home Banner</h3>
    </div>
    <hr>
    <form action="{{route('home_banner.save')}}" method="post" enctype="multipart/form-data">
        @csrf
		
        @error('image')
		<div class="alert alert-danger" role="alert">
			{{$message}}
		</div>
		@enderror	
			<div class="form-group">
				<label for="image" class="control-label mb-1">Select Image</label>
				<input id="image" name="image" type="file" class="form-control">
			</div>
		
		    @error('btn_txt')
        <div class="alert alert-danger">
             {{$message}}
        </div>
        @enderror
        <div class="form-group">
            <label for="btn_txt" class="control-label mb-1">Btn Text</label>
            <input id="btn_txt" name="btn_txt" type="text" class="form-control">
        </div>
		
         @error('btn_link')
        <div class="alert alert-danger">
            {{$message}}
        </div>
        @enderror
        <div class="form-group">
            <label for="btn_link" class="control-label mb-1">Btn Link</label>
            <input id="btn_link" name="btn_link" type="text" class="form-control">
        </div>

        <div>
            <button type="submit" class="btn btn-info">Save Record</button>
        </div>
    </form>
</div>
</div>
 
	</div>
</div>

@endsection