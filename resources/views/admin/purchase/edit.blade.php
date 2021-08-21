@extends('admin/layout')
@section('content')
@section('purchase_select','active')

<a class="btn btn-primary btn-lg mt-2" href="all" role="button"><i class="fas fa-backward"></i> Back</a>
<div class="row mt-2">
<div class="col-lg-12">
	<div class="card">
	  <div class="card-body">
		<div class="card-title">
			<h3 class="text-center title-2">Edit Purchase</h3>
		</div>
		<hr>
	<form action="{{route('purchase.update')}}" method="post">
		@csrf

		@error('purchase_date')
		<div class="alert alert-danger" role="alert">
			{{$message}}
		</div>
		@enderror
		<div class="form-group">
			<label for="purchase_date" class="control-label mb-1">Date</label>
			<input id="purchase_date" name="purchase_date" type="Date" value="{{$purchase_date}}" class="form-control">
		</div>
				
			@error('invoice_no')
		<div class="alert alert-danger" role="alert">
			{{$message}}
		</div>
		@enderror
		<div class="form-group">
			<label for="invoice_no" class="control-label mb-1">Invoice No</label>
			<input id="invoice_no" name="invoice_no" type="text" value="{{$invoice_no}}" class="form-control">
	   </div>
				
			@error('company_name')
		<div class="alert alert-danger" role="alert">
			{{$message}}
		</div>
		@enderror
		<div class="form-group">
		   <label for="company_name" class="control-label mb-1">Company Name</label>
		   <input id="company_name" name="company_name" type="text" value="{{$company_name}}" class="form-control">
		</div>
				
			@error('total_amount')
		<div class="alert alert-danger" role="alert">
			{{$message}}
		</div>
		@enderror
		<div class="form-group">
		   <label for="total_amount" class="control-label mb-1">Total Amount</label>
		   <input id="total_amount" name="total_amount" type="text" value="{{$total_amount}}" class="form-control">
		</div>
			<div>
				<input type="hidden" name="purchase_id" value="{{$purchase_id}}">
				<button id="payment-button" type="submit" class="btn btn-lg btn-info"><i class="fas fa-save"></i> Save Record</button>
			</div>
			</form>
		</div>
	</div>
</div>
</div>
@endsection