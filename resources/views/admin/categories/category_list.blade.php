@extends('admin/layout')
@section('page_title','Category List')
@section('category_select', 'active')
@section('container')

@if(session('msg'))
 <div class="alert alert-success">
 {{session('msg')}}
 </div>
 @endif

<div class="row">
<div class="col-lg-12">
<h1 class="mb-4">Category</h1>

<a class="btn btn-success" href="{{url('admin/category/create')}}">Create</a>
	    <div class="table-responsive table--no-card m-t-10">
	        <table class="table table-borderless table-striped table-earning">
	            <thead>
	                <tr>
	                    <th>ID</th>
						<th>Is Home</th>
	                    <th>Image</th>
	                    <th>Category Name</th>
	                    <th>Category Slug</th>
	                    <th>Parent</th>
	            	    <th>Action</th>
	                </tr>
	            </thead>
	            <tbody>
	            	@php $sno=1; @endphp
	            	@foreach($data as $row)
	            	@php
	            	$data = DB::table('categories')->where(['id'=>$row->parent_category_id])->get();
	            	@endphp
	                <tr>
	                    <td>{{$sno++}}</td>
						<td>
							@if($row->is_home==1)
							<label class="switch switch-text switch-success switch-pill">
							<input type="checkbox" class="switch-input" checked="true" disabled>
							<span data-on="On" data-off="Off" class="switch-label"></span>
							<span class="switch-handle"></span>
						  </label>
						  @else
						  <label class="switch switch-text switch-danger switch-pill">
							<input type="checkbox" class="switch-input" checked="false" disabled>
							<span data-on="Off" data-off="On" class="switch-label"></span>
							<span class="switch-handle"></span>
						  </label>
						  @endif
						
						</td>
	                    <td><img src="{{asset('public/uploads/'.$row->category_image)}}" width="100px"></td>
	                    <td>{{$row->category_name}}</td>
	                    <td>{{$row->category_slug}}</td>
	                    <td>@php 
	                    	if(isset($data[0]))
	                    	echo $data[0]->category_name;
	                    	else
	                    	echo "N/A";
	                    @endphp</td>
	                    <td>
	                    <a href="{{url("admin/category/edit/$row->id")}}" class="btn btn-warning btn-sm">Edit</a>
	                    @if($row->status==1)
                            <a href="{{url('admin/category/status/0')}}/{{$row->id}}"><button type="button" class="btn btn-primary btn-sm">Active</button></a>
                         @elseif($row->status==0)
                            <a href="{{url('admin/category/status/1')}}/{{$row->id}}"><button type="button" class="btn btn-warning btn-sm">Deactive</button></a>
                        @endif
	                    <a href="{{url("admin/category/delete/$row->id")}}" class="btn btn-danger btn-sm">Delete</a></td>
	                </tr>
	                @endforeach
	                
	            </tbody>
	        </table>
	    </div>
	</div>
</div>

@endsection