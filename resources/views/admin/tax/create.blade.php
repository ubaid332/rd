@extends('admin/layout')
@section('page_title','Create Tax')
@section('tax_select','active')
@section('container')
<div class="row">
<div class="col-lg-12">

 
 
<div class="card">

<div class="card-body">
    <div class="card-title">
        <h3 class="text-center title-2">Create tax</h3>
    </div>
    <hr>
    <form action="{{route('tax.save')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="tax_desc" class="control-label mb-1">Tax Desc</label>
            <input id="tax_desc" name="tax_desc" type="text" class="form-control">
        </div>
        @error('tax_desc')
        <div class="alert alert-danger">
            {{$message}}
        </div>
        @enderror
            
        <div class="form-group">
            <label for="tax_value" class="control-label mb-1">Tax Value</label>
            <input id="tax_value" name="tax_value" type="text" class="form-control">
        </div>
       @error('tax_value')
        <div class="alert alert-danger">
       code     {{$message}}
        </div>
        @enderror

        <div>
            <button type="submit" class="btn btn-lg btn-info">Save Record</button>
        </div>
    </form>
</div>
</div>
 
	</div>
</div>

@endsection