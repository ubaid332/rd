@extends('admin/layout')
@section('page_title','Create Category')
@section('category_select', 'active')
@section('container')
<div class="row">
<div class="col-lg-12">

 
 
<div class="card">

<div class="card-body">
    <div class="card-title">
        <h3 class="text-center title-2">Create Category</h3>
    </div>
    <hr>
    <form action="{{route('category.save')}}" method="post" enctype="multipart/form-data">
        @csrf

          <div class="row">
            <div class="col-md-4">

        <div class="form-group">
            <label for="category_name" class="control-label mb-1">Category Name</label>
            <input id="category_name" name="category_name" type="text" class="form-control">
        </div>
        @error('category_name')
        <div class="alert alert-danger">
            {{$message}}
        </div>
        @enderror

        </div>
          <div class="col-md-4">
            <label for="category_name" class="control-label mb-1">Parent  Category</label>
            <select id="parent_category_id" name="parent_category_id" class="form-control" required>
            <option value="0">Select Categories</option>
            @foreach($category as $list)
            <option value="{{$list->id}}">{{$list->category_name}}</option>
            @endforeach
        </select>
        </div>
        <div class="col-md-4">

            <div class="form-group">
            <label for="category_slug" class="control-label mb-1">Category Slug</label>
            <input id="category_slug" name="category_slug" type="text" class="form-control">
        </div>
       @error('category_slug')
        <div class="alert alert-danger">
            {{$message}}
        </div>
        @enderror

        </div>
    </div>

     <div class="row">
            <div class="col-md-9">

        <div class="form-group">
            <label for="image" class="control-label mb-1">Image</label>
            <input id="image" name="image" type="file" class="form-control">
        </div>
        @error('image')
        <div class="alert alert-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="image" class="control-label mb-1"> Show in Home Page</label>
            <input id="is_home" name="is_home" type="checkbox" style="margin-top:40px;">
        </div>
    </div>
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