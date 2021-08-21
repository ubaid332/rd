@extends('admin/layout')
@section('content')
@section('order_select','active')

<a class="btn btn-primary btn-lg mt-2" href="all" role="button"><i class="fas fa-backward"></i> Back</a>
<div class="row mt-2">
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<div class="card-title">
				<h3 class="text-center title-2">Edit Order</h3>
			</div>
			<hr>
		<form action="{{route('order.update')}}" method="post">
			@csrf

			@error('order_date')
		<div class="alert alert-danger" role="alert">
			{{$message}}
		</div>
		@enderror
		<div class="form-group">
			<label for="order_date" class="control-label mb-1">Order Date</label>
			<input id="order_date" name="order_date" type="date" value="{{$order_date}}" class="form-control" >
		</div>

			@error('customer_id')
	<div class="alert alert-danger" role="alert">
			{{$message}}
	</div>
		@enderror
	<div class="form-group">
	   <label for="customer_id" class="control-label mb-1">Category</label>
	   <select id="customer_id" name="customer_id" type="text" value="{{$customer_id}}" class="form-control">
		<option>Select Customer</option>
		@foreach($customers as $customer)
		<option value="{{$customer->id}}">{{$customer->customer_name}}</option>
		@endforeach
	   </select>	   
	</div>

		 @error('order_detail')
		<div class="alert alert-danger" role="alert">
			{{$message}}
		</div>
		@enderror
		<div class="form-group">
			<label for="order_detail" class="control-label mb-1">Order Detail</label>
			<input id="order_detail" name="order_detail" type="text" value="{{$order_detail}}" class="form-control" >
		</div>

			@error('order_type')
		<div class="alert alert-danger" role="alert">
			{{$message}}
		</div>
		@enderror
		<div class="form-group">
			<label for="order_type" class="control-label mb-1">Order Type</label>
			<input id="order_type" name="order_type" type="text" value="{{$order_type}}" class="form-control" >
		</div>

			@error('total_amount')
		<div class="alert alert-danger" role="alert">
			{{$message}}
		</div>
		@enderror
		<div class="form-group">
			<label for="total_amount" class="control-label mb-1">Total Amount</label>
			<input id="total_amount" name="total_amount" type="text" value="{{$total_amount}}" class="form-control" >
		</div>

			@error('advance_amount')
		<div class="alert alert-danger" role="alert">
			{{$message}}
		</div>
		@enderror
		<div class="form-group">
			<label for="advance_amount" class="control-label mb-1">Advance Amount</label>
			<input id="advance_amount" name="advance_amount" type="text" value="{{$advance_amount}}" class="form-control" >
		</div>

			<div>
				<input type="hidden" name="order_id" value="{{$order_id}}">
					<button type="submit" class="btn btn-lg btn-info">Save Record</button>
			</div>
		</form>
		</div>
	</div>
</div>
</div>
@endsection