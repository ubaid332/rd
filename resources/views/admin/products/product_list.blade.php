@extends('admin/layout')
@section('page_title','Product')
@section('product_select','active')
@section('container')
    @if(session()->has('message'))
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
        {{session('message')}}  
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
    @endif                     
    <h1 class="mb10">Product</h1>
    <a href="{{url('admin/product/create')}}">
        <button type="button" class="btn btn-success">
            Add Product
        </button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Slug</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->name}}</td>
                            <td> @if($list->c_status) <i class="fa fa-check"></i> @endif {{$list->category_name}} @if($list->is_home) <br> <small class="text-success"><span class="badge badge-success">On Home Visible</span></small> @endif</td>
                            <td>{{$list->slug}}</td>
                            <td>
                            @if($list->image!='')
                                <img width="100px" src="{{asset('public/uploads/'.$list->image)}}"/>
                               
                            @endif
                            </td>
                            <td>
                                <a href="{{url("admin/product/edit/$list->id")}}" class="btn btn-sm btn-success">Edit</a>

                                @if($list->status==1)
                                    <a href="{{url('admin/product/status/0')}}/{{$list->id}}" class="btn btn-sm btn-primary">Active</a>
                                 @elseif($list->status==0)
                                    <a href="{{url('admin/product/status/1')}}/{{$list->id}}" class="btn btn-sm btn-warning">Deactive</a>
                                @endif

                                <a href="{{url('admin/product/delete/')}}/{{$list->id}}" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
                        
@endsection