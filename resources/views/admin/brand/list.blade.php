@extends('admin/layout')
@section('page_title','Brand List')
@section('brand_select','active')
@section('container')

@if(session('msg'))
 <div class="alert alert-success">
 {{session('msg')}}
 </div>
 @endif

<div class="row">
<div class="col-lg-12">
<h1 class="mb-4">Brands</h1>
<a class="btn btn-success" href="{{url('admin/brand/create')}}">Create</a>
	    <div class="table-responsive table--no-card m-t-10">
	        <table class="table table-borderless table-striped table-earning">
	            <thead>
	                <tr>
	                    <th>ID</th>
						<th>Image</th>
						<th>Name</th>
	                    <th>Is Home</th>
	            	    <th>Action</th>
	                </tr>
	            </thead>
	            <tbody>

	            	@foreach($data as $row)
	                <tr>
	                    <td>{{$row->id}}</td>
	                    
						<td><img width="100" src="{{asset('brands/'.$row->image)}}"></td>
						<td>{{$row->name}}</td>
	                    <td>@php
	                    	if($row->is_home==1)
	                    	echo "Yes";
	                    	else
	                    	echo "No";
	                    	@endphp
	                    </td>
	                    
						<td><a href="{{url("admin/brand/edit/$row->id")}}" class="btn btn-warning btn-sm">Edit</a> 
							
						@if($row->status==1)
					<a href="{{url("admin/brand/status/0/$row->id")}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Active</a>
					@else
					<a href="{{url("admin/brand/status/1/$row->id")}}" class="btn btn-danger btn-sm"><i class="far fa-eye-slash"></i> InActive</a>
					@endif
							
						<a href="{{url("admin/brand/delete/$row->id")}}" onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>Delete</a>
				
						</td>
	                </tr>
	                @endforeach
	                
	            </tbody>
	        </table>
	    </div>
	</div>
</div>

@endsection