@extends('admin/layout')
@section('page_title','Coupon List')
@section('coupon_select','active')
@section('container')

@if(session('msg'))
 <div class="alert alert-success">
 {{session('msg')}}
 </div>
 @endif

<div class="row">
<div class="col-lg-12">
<h1 class="mb-4">Coupons</h1>
<a class="btn btn-success" href="{{url('admin/coupon/create')}}">Create</a>
	    <div class="table-responsive table--no-card m-t-10">
	        <table class="table table-borderless table-striped table-earning">
	            <thead>
	                <tr>
	                    <th>ID</th>
	                    <th>Coupon Title</th>
	                    <th>Coupon Code</th>
	                    <th>Coupon Value</th>
	            	    <th>Action</th>
	                </tr>
	            </thead>
	            <tbody>

	            	@foreach($data as $row)
	                <tr>
	                    <td>{{$row->id}}</td>
	                    <td>{{$row->title}}</td>
	                    <td>{{$row->code}}</td>
	                    <td>{{$row->value}}</td>
	                 
	                    <td>
                                <a href="{{url('admin/coupon/edit/')}}/{{$row->id}}"><button type="button" class="btn btn-success">Edit</button></a>

                                @if($row->status==1)
                                    <a href="{{url('admin/coupon/status/0')}}/{{$row->id}}"><button type="button" class="btn btn-primary">Active</button></a>
                                 @elseif($row->status==0)
                                    <a href="{{url('admin/coupon/status/1')}}/{{$row->id}}"><button type="button" class="btn btn-warning">Deactive</button></a>
                                @endif
                                
                                <a href="{{url('admin/coupon/delete/')}}/{{$row->id}}"><button type="button" class="btn btn-danger">Delete</button></a>
                                
                            </td>
	                </tr>
	                @endforeach
	                
	            </tbody>
	        </table>
	    </div>
	</div>
</div>

@endsection