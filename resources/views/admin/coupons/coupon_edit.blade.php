@extends('admin/layout')
@section('page_title','Edit Coupon')
@section('coupon_select','active')
@section('container')
<div class="row">
<div class="col-lg-12">

 
 
<div class="card">

<div class="card-body">
    <div class="card-title">
        <h3 class="text-center title-2">Edit Coupon</h3>
    </div>
    <hr>
    <form action="{{route('coupon.update')}}" method="post">
        @csrf
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label for="title" class="control-label mb-1">Title</label>
                    <input id="title" value="{{ old('title') }}" name="title" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                </div>
                @error('title')
                    <div class="alert alert-danger" role="alert">
                        {{$message}}    
                    </div>
                    @enderror
                <div class="col-md-6">
                    <label for="code" class="control-label mb-1">Code</label>
                    <input id="code" value="{{ old('code') }}" name="code" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                </div>
                @error('code')
                    <div class="alert alert-danger" role="alert">
                        {{$message}}    
                    </div>
                    @enderror
            </div>
        </div>

        <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="value" class="control-label mb-1">Value</label>
                        <input id="value" name="value" type="text" value="{{ old('value') }}" class="form-control" aria-required="true" aria-invalid="false" required>
                    </div>
                    @error('value')
                    <div class="alert alert-danger" role="alert">
                        {{$message}}    
                    </div>
                    @enderror
                    <div class="col-md-6">
                        <label for="value" class="control-label mb-1">Type</label>
                        <select id="type" name="type" class="form-control" required>
    @if($type=='Value')
    <option value="Value" selected>Value</option>
    <option value="Per">Per</option>
    @elseif($type=='Per')
    <option value="Value">Value</option>
    <option value="Per" selected>Per</option>
    @else
    <option value="Value">Value</option>
    <option value="Per">Per</option>
    @endif
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="title" class="control-label mb-1">Min Order Amt</label>
                            <input id="min_order_amt" value="{{ old('min_order_amt') }}" name="min_order_amt" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                        </div>
                         @error('min_order_amt')
                    <div class="alert alert-danger" role="alert">
                        {{$message}}    
                    </div>
                    @enderror
                        <div class="col-md-6">
                            <label for="code" class="control-label mb-1">IS One Time</label>
                            <select id="is_one_time" name="is_one_time" class="form-control" required>
        @if($is_one_time=='1')
        <option value="1" selected>Yes</option>
        <option value="0">No</option>
        @else
        <option value="1">Yes</option>
        <option value="0" selected>No</option>
        @endif
                            </select>
                        </div>
                    </div>
                            </div>
        <div>
            <input type="hidden" name="coupon_id" value="{{ ('$coupon_id') }}">
            <button type="submit" class="btn btn-info">Save Record</button>
        </div>
    </form>
</div>
</div>
 
	</div>
</div>

@endsection