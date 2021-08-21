@extends('admin/layout')
@section('content')
@section('page_title','All Purchases')
@section('purchase_select','active')

@if(session('msg'))
<div class="alert alert-success" role="alert">
{{session('msg')}}
</div>
@endif

<h2>Purchases Record</h2>

<a class="btn btn-primary btn-lg mt-2" href="create" role="button"><i class="fas fa-plus-circle"></i> Add Purchase Record</a>
<div class="row mt-2">
	<div class="col-lg-12">
	<div class="table-responsive table--no-card m-b-30">
	<table class="table table-borderless table-striped table-earning">
	<thead>
  <tr>
	<th>S.No</th>
	<th>Date</th>
	<th>Invoice No</th>
	<th>Company Name</th>
	<th>Total Amount</th>
	<th>Action</th>
  </tr>
	</thead>
	<tbody>
		{{$sno = 1}}

		@foreach($data as $row)
   <tr>
	<td>{{$sno++}}</td>
	<td>{{$row->purchase_date}}</td>
	<td>{{$row->invoice_no}}</td>
	<td>{{$row->company_name}}</td>
	<td>{{$row->total_amount}}</td>
  <td>
		<a href="{{url("admin/purchase/edit/$row->id")}}" class="btn btn-warning"><i class="far fa-edit"></i> Edit</a>
		@if($row->status==1)
		<a href="{{url("admin/purchase/status/$row->id/0")}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Active</a>
		@else
		<a href="{{url("admin/purchase/status/$row->id/1")}}" class="btn btn-danger btn-sm"><i class="far fa-eye-slash"></i> InActive</a>
		@endif

		<a href="{{url("admin/purchase/delete/$row->id")}}" onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</a>
	 </td>
	</tr>
		@endforeach
	</tbody>
	</table>
	</div>
  </div>
</div>
@endsection