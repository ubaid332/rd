@extends('admin/layout')
@section('container')
@section('page_title','All Orders')
@section('order_select','active')

@if(session('msg'))
<div class="alert alert-success" role="alert">
{{session('msg')}}
</div>
@endif

<h2>Order Records</h2>

<div class="row mt-2">
	<div class="col-lg-12">
		<div class="table-responsive table--no-card m-b-30">
		<table class="table table-borderless table-striped table-earning">
		<thead>
		<tr>
		<th>Order ID</th>
		<th>Order Type</th>
		<th>Customer Detail</th>
		<th>Amt</th>
		<th>Order Status</th>
		<th>Payment Status</th>
		<th>Payment Type</th>
		<th>Order Date</th>
		<th>Action</th>
		</tr>
		</thead>
		<tbody>
			
		@foreach($data as $row)
		<tr>
		<td><a href="{{url('/admin/order_detail')}}/{{$row->id}}">{{$row->id}}</a></td>
		<td>
			@if($row->order_type=="Cash")
			{{ $row->order_type }}
			@else
			<a href="{{ url("admin/order_installments/$row->id") }}">{{ $row->order_type }}</a>
			@endif
		
		</td>
		<td>{{$row->name}}<br>{{$row->mobile}}<br>{{$row->email}}<br>
			{{$row->address}},{{$row->city}},{{$row->state}},{{$row->pincode}}
		</td>
		<td>{{$row->total_amt}}</td>
		<td>{{$row->orders_status}}</td>
		<td>{{$row->payment_status}}</td>
		<td>{{$row->payment_type}}</td>
		<td>{{$row->added_on}}</td>
		 <td>
			{{--
			<a href="{{url("admin/order/edit/$row->id")}}" class="btn btn-warning btn-sm"><i class="far fa-edit"></i> Edit</a>
			
			@if($row->status==1)
				<a href="{{url("admin/order/status/$row->id/0")}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Active</a>
				@else
				<a href="{{url("admin/order/status/$row->id/1")}}" class="btn btn-danger btn-sm"><i class="far fa-eye-slash"></i> InActive</a>
				@endif
			--}}
			<a href="{{url("admin/order/delete/$row->id")}}" onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</a>
		</td> 
		</tr>
			@endforeach
		</tbody>
		</table>
		</div>

	</div>
</div>
@endsection