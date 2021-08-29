@extends('admin/layout')
@section('container')
@section('page_title','All Customers')
@section('customer_select','active')

@if(session('msg'))
<div class="alert alert-success" role="alert">
{{session('msg')}}
</div>
@endif

<h2>Customers</h2>
<a class="btn btn-primary mt-2" href="create" role="button"><i class="fas fa-plus-circle"></i> Add New</a>
<div class="row mt-2">
	<div class="col-lg-12">
		<div class="table-responsive table--no-card m-b-30">
		<table class="table table-borderless table-striped table-earning">
		<thead>
		<tr>
		<th>S.No</th>
		<th>Image</th>
		<th>Name</th>
		<th>Father</th>
		<th>CNIC</th>
		<th>Email</th>
		<th>Address</th>
		<th>Mobile</th>
		<th>City</th>
		<th>State</th>
		<th>Action</th>
		</tr>
		</thead>
		<tbody>
			@php $sno = 1 @endphp
		@foreach($data as $row)
		<tr>
		<td>{{$sno++}}</td>
		<td>@if($row->image)<img width="100" src="{{asset('public/uploads/'.$row->image)}}">@endif</td>
		<td>{{$row->name}}</td>
		<td>{{$row->father_name}}</td>
		<td>{{$row->cnic}}</td>
		<td>{{$row->email}}</td>
		<td>{{$row->address}}</td>
		<td>{{$row->mobile}}</td>
		<td>{{$row->city}}</td>
		<td>{{$row->state}}</td>
		<td>
			<a href="{{url("admin/customer/edit/$row->id")}}"class="btn btn-warning btn-sm"><i class="far fa-edit"></i> Edit</a>
			
			@if($row->status==1)
				<a href="{{url("admin/customer/status/$row->id/0")}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Active</a>
				@else
				<a href="{{url("admin/customer/status/$row->id/1")}}" class="btn btn-danger btn-sm"><i class="far fa-eye-slash"></i> InActive</a>
				@endif
			
			<a href="{{url("admin/customer/delete/$row->id")}}" onclick="return confirm('Are you sure to delete this?')"  class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</a>
		</td>
		</tr>
			@endforeach
		</tbody>
		</table>
		</div>

	</div>
</div>
@endsection