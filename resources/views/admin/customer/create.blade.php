@extends('admin/layout')
@section('container')
@section('page_title','Create Customer')
@section('customer_select','active')

<h2>Add Customer</h2>
<a class="btn btn-primary mt-2" href="list" role="button"><i class="fas fa-backward"></i> Back</a>
<div class="row mt-2">
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<div class="card-title">
				<h3 class="text-center title-2">Add Customer</h3>
			</div>
			<hr>
			<form action="{{route('customer.save')}}" method="post" enctype="multipart/form-data">
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
		
		<div class="row">
			<div class="col-lg-6">
			 @error('name')
		<div class="alert alert-danger" role="alert">
			{{$message}}
		</div>
		@enderror	
			<div class="form-group">
				<label for="name" class="control-label mb-1">Name</label>
				<input id="name" name="name" type="text" class="form-control">
			</div>

		</div>
		<div class="col-lg-6">

				  @error('father_name')
			<div class="alert alert-danger" role="alert">
			{{$message}}
			</div>
			@enderror
				<div class="form-group">
					<label for="father_name" class="control-label mb-1">Father Name</label>
					<input id="father_name" name="father_name" type="text" class="form-control">
			   </div>
			</div>
			</div>

			<div class="row">
			<div class="col-lg-6">	
				  @error('cnic')
			  <div class="alert alert-danger" role="alert">
				   {{$message}}
			  </div>
				@enderror
				      
					<div class="form-group">
					   <label for="cnic" class="control-label mb-1">CNIC</label>
					   <input id="cnic" name="cnic" type="text" class="form-control">
					</div>

			</div>
			<div class="col-lg-6">

				@error('email')
			  <div class="alert alert-danger" role="alert">
				   {{$message}}
			  </div>
				@enderror
				      
					<div class="form-group">
					   <label for="email" class="control-label mb-1">Email</label>
					   <input id="email" name="email" type="text" class="form-control">
					</div>
			  
			  </div>
			</div>

			<div class="row">
			<div class="col-lg-6">
					  @error('address')
					<div class="alert alert-danger" role="alert">
					 {{$message}}
					</div>
						@enderror
						<div class="form-group">
						   <label for="address" class="control-label mb-1">Address</label>
						   <input id="address" name="address" type="text" class="form-control">
						</div>
			</div>
			<div class="col-lg-6"> 
						  @error('mobile')
					 <div class="alert alert-danger" role="alert">
						 {{$message}}
					 </div>
					   @enderror
							<div class="form-group">
							   <label for="mobile" class="control-label mb-1">Mobile</label>
							   <input id="mobile" name="mobile" type="text" class="form-control">
							</div>
				</div>
				</div>

			<div class="row">
			<div class="col-lg-6">	
						  @error('city')
					 <div class="alert alert-danger" role="alert">
						 {{$message}}
					 </div>
						 @enderror
							<div class="form-group">
							   <label for="city" class="control-label mb-1">City</label>
							   <input id="city" name="city" type="text" class="form-control">
						   </div>

			</div>
			<div class="col-lg-6">

						@error('state')
					 <div class="alert alert-danger" role="alert">
						 {{$message}}
					 </div>
						 @enderror
							<div class="form-group">
							   <label for="state" class="control-label mb-1">State</label>
							   <input id="state" name="state" type="text" class="form-control">
						   </div>
			</div>
			</div>	
				<div>
					<button id="payment-button" type="submit" class="btn btn-info"><i class="fas fa-save"></i> Save Record</button>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
@endsection