@extends('admin/layout')
@section('page_title','HomeBanner List')
@section('container')

@if(session('msg'))
 <div class="alert alert-success">
 {{session('msg')}}
 </div>
 @endif

<div class="row">
<div class="col-lg-12">
<h1 class="mb-4">Home Banners</h1>
<a class="btn btn-success" href="{{url('admin/home_banner/create')}}">Create</a>
	    <div class="table-responsive table--no-card m-t-10">
	        <table class="table table-borderless table-striped table-earning">
	            <thead>
	                <tr>
	                    <th>ID</th>
	                    <th>Image</th>
	                    <th>Btn Text</th>
	                    <th>Btn Link</th>
	            	    <th>Action</th>
	                </tr>
	            </thead>
	            <tbody>

	            	@foreach($data as $row)
	                <tr>
	                    <td>{{$row->id}}</td>
	                    <td><img width="100" src="{{asset('public/uploads/'.$row->image)}}"></td>
	                    <td>{{$row->btn_txt}}</td>
	                    <td>{{$row->btn_link}}</td>
						
				<td>
					<a href="{{url("admin/home_banner/edit/$row->id")}}" class="btn btn-sm btn-warning"><i class="far fa-edit"></i> Edit</a>
					@if($row->status==1)
					<a href="{{url("admin/home_banner/status/0/$row->id")}}" class="btn btn-sm btn-primary btn-sm"><i class="fas fa-eye"></i> Active</a>
					@else
					<a href="{{url("admin/home_banner/status/1/$row->id")}}" class="btn btn-sm btn-danger btn-sm"><i class="far fa-eye-slash"></i> InActive</a>
					@endif

					<a href="{{url("admin/home_banner/delete/$row->id")}}" onclick="return confirm('Are you sure to delete this?')" class="btn btn-sm btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</a>
				</td>
	                </tr>
	                @endforeach
	                
	            </tbody>
	        </table>
	    </div>
	</div>
</div>

@endsection