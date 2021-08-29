@extends('admin/layout')
@section('page_title','Edit Product')
@section('product_select','active')
@section('container')
@if($id>0)
{{$image_required=""}}
@else
{{$image_required="required"}}
@endif


@if(session()->has('sku_error'))
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
   {{session('sku_error')}}  
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">×</span>
   </button>

</div> 
@endif

@error('attr_image.*')
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
   {{$message}}  
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">×</span>
   </button>
</div> 
@enderror

<h1 class="mb10">Edit Product</h1>
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<a href="{{url('admin/product')}}">
<button type="button" class="btn btn-success">
Back
</button>
</a>
<div class="row m-t-30">
   <div class="col-md-12">
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-body">
                  <form action="{{route('product.update')}}" method="post" enctype="multipart/form-data">
                     @csrf

                     <div class="row">
                     <div class="col-md-6">
                     <div class="form-group">
                        <label for="name" class="control-label mb-1"> Name</label>
                        <input id="name" value="{{$name}}" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                        @error('name')
                        <div class="alert alert-danger" role="alert">
                           {{$message}}     
                        </div>
                        @enderror
                     </div>
                     </div>

                     <div class="col-md-6">
                     <div class="form-group">
                        <label for="slug" class="control-label mb-1"> Slug</label>
                        <input id="slug" value="{{$slug}}" name="slug" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                        @error('slug')
                        <div class="alert alert-danger" role="alert">
                           {{$message}}     
                        </div>
                        @enderror
                     </div>
                     </div>
                     </div>

                     <div class="row">
                     <div class="col-md-6">
                     <div class="form-group">
                        <label for="image" class="control-label mb-1"> Image</label>
                        <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" {{$image_required}}>
                        @error('image')
                        <div class="alert alert-danger" role="alert">
                           {{$message}}     
                        </div>
                        @enderror
                     </div>
                     </div>

                     <div class="col-md-6">
                     <div class="form-group">
                        <label for="category_id" class="control-label mb-1"> Category</label>
                        <select id="category_id" name="category_id" class="form-control" required>
                           <option value="">Select Categories</option>
                           @foreach($category as $list)
                           @if($category_id==$list->id)
                           <option selected value="{{$list->id}}">
                              @else
                           <option value="{{$list->id}}">
                              @endif
                              {{$list->category_name}}
                           </option>
                           @endforeach
                        </select>
                     </div>
                     </div>
                     </div>

                     <div class="row">
                     <div class="col-md-6">
                     <div class="form-group">
                        <label for="brand" class="control-label mb-1"> Brand</label>
                              <select id="brand" name="brand" class="form-control" required>
                                 <option value="">Select Brand</option>
                                 @foreach($brands as $list)
                                 @if($brand==$list->id)
                                 <option selected value="{{$list->id}}">
                                    @else
                                 <option value="{{$list->id}}">
                                    @endif
                                    {{$list->name}}
                                 </option>
                                 @endforeach
                              </select>
                     </div>
                     </div>

                     <div class="col-md-6">
                     <div class="form-group">
                        <label for="model" class="control-label mb-1"> Model</label>
                        <input id="model" value="{{$model}}" name="model" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                     </div>
                     </div>
                     </div>

                     <div class="row">
                     <div class="col-md-12">
                     <div class="form-group">
                        <label for="short_desc" class="control-label mb-1"> Short Desc</label>
                        <textarea id="short_desc" name="short_desc" type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$short_desc}}</textarea>
                     </div>
                     </div>
                  </div>

                   <div class="row">
                     <div class="col-md-12">
                     <div class="form-group">
                        <label for="desc" class="control-label mb-1"> Desc</label>
                        <textarea id="desc" name="desc" type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$desc}}</textarea>
                     </div>
                     </div>
                     </div>

                     <div class="row">
                        <div class="col-md-12">
                     <div class="form-group">
                        <label for="technical_specification" class="control-label mb-1"> Technical Specification</label>
                        <textarea id="technical_specification" name="technical_specification" type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$technical_specification}}</textarea>
                     </div>
                     </div>
                     </div>

                     <div class="row">
                     <div class="col-md-4">
                     <div class="form-group">
                        <label for="keywords" class="control-label mb-1"> Keywords</label>
                        <textarea id="keywords" name="keywords" type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$keywords}}</textarea>
                     </div>
                     </div>

                     <div class="col-md-4">
                     <div class="form-group">
                        <label for="uses" class="control-label mb-1"> Uses</label>
                        <textarea id="uses" name="uses" type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$uses}}</textarea>
                     </div>
                     </div>

                     <div class="col-md-4">
                     <div class="form-group">
                        <label for="warranty" class="control-label mb-1"> Warranty</label>
                        <textarea id="warranty" name="warranty" type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$warranty}}</textarea>
                     </div>
                     </div>
                     </div>

                     <div class="row">
                           <div class="col-md-8">
                              <label for="model" class="control-label mb-1"> Lead Time</label>
                              <input id="lead_time" value="{{$lead_time}}" name="lead_time" type="text" class="form-control" aria-required="true" aria-invalid="false">
                           </div>
                           <div class="col-md-4">
                              <label for="model" class="control-label mb-1"> Tax</label>
                              <select id="tax_id" name="tax_id" class="form-control" required>
                                 <option value="">Select Tax</option>
                                 @foreach($taxs as $list)
                                  @if($tax_id==$list->id)
                                 <option selected value="{{$list->id}}">
                                    @else
                                 <option value="{{$list->id}}">
                                    @endif
                                    {{$list->tax_desc}}
                                 </option>
                                 @endforeach
                              </select>
                           </div>
                          
                        </div>

                         <div class="row">
                           <div class="col-md-3">
                              <label for="model" class="control-label mb-1"> IS Promo  </label>
                              <select id="is_promo" name="is_promo" class="form-control" required>
                              @if($is_promo=='1')
                              <option value="1" selected>Yes</option>
                              <option value="0">No</option>
                              @else
                              <option value="1">Yes</option>
                              <option value="0" selected>No</option>
                              @endif
                    
                              </select>
                           </div>
                           <div class="col-md-3">
                              <label for="model" class="control-label mb-1"> IS Featured  </label>
                              <select id="is_featured" name="is_featured" class="form-control" required>
                     
                              @if($is_featured=='1')
                              <option value="1" selected>Yes</option>
                              <option value="0">No</option>
                              @else
                              <option value="1">Yes</option>
                              <option value="0" selected>No</option>
                              @endif
                    
                              </select>
                           </div>
                           <div class="col-md-3">
                              <label for="model" class="control-label mb-1"> IS Tranding  </label>
                              <select id="is_tranding" name="is_tranding" class="form-control" required>
                     
                              @if($is_tranding=='1')
                               <option value="1" selected>Yes</option>
                               <option value="0">No</option>
                               @else
                               <option value="1">Yes</option>
                               <option value="0" selected>No</option>
                               @endif
                     
                              </select>
                           </div>
                           <div class="col-md-3">
                              <label for="model" class="control-label mb-1"> IS Discounted   </label>
                              <select id="is_discounted" name="is_discounted" class="form-control" required>
                     
                              @if($is_discounted=='1')
                              <option value="1" selected>Yes</option>
                              <option value="0">No</option>
                              @else
                              <option value="1">Yes</option>
                              <option value="0" selected>No</option>
                              @endif
                     
                              </select>
                           </div>
                        </div>

                     <div class="row">
                        <h2 class="mb10 ml15">Product Images</h2>
            <div class="col-lg-12">
               <button type="button" class="btn btn-success btn-sm" onclick="add_image_more()">
                   <i class="fa fa-plus"></i>&nbsp; Add</button>
               <div class="card">
                  <div class="card-body">
                     <div class="form-group">
                        <div class="row" id="product_images_box">
                        @php 
                        $loop_count_num=1;
                        @endphp
                        @foreach($productImagesArr as $key=>$val)
                        @php 
                        $loop_count_prev=$loop_count_num;
                        $pIArr=(array)$val;
                        @endphp
                        <input id="piid" type="hidden" name="piid[]" value="{{$pIArr['id']}}">
                        <div class="col-md-4 product_images_{{$loop_count_num++}}"  >
                              <label for="images" class="control-label mb-1"> Image</label>
                              <input id="images" name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false" >

                              @if($pIArr['images']!='')
                                 <a href="{{asset('storage/media/'.$pIArr['images'])}}" target="_blank"><img width="100px" src="{{asset('public/uploads/'.$pIArr['images'])}}"/></a>
                              @endif
                           </div>
                           
                           <div class="col-md-2">
                              <label for="images" class="control-label mb-1"> 
                              &nbsp;&nbsp;&nbsp;</label>
                              
                              <a href="{{url('admin/product/product_images_delete/')}}/{{$pIArr['id']}}/{{$id}}"><button type="button" class="btn btn-danger btn-sm">
                                <i class="fa fa-minus"></i>&nbsp; Remove</button></a>
                             

                           </div>
                           @endforeach
                        </div>
                     </div>
                  </div>
               </div>
               
            </div>
                     </div>

                        
                        <div class="row">
                        <h2 class="mb10 ml15">Product Attributes</h2>
                        <div class="col-lg-12" id="product_attr_box">
                        <button type="button" class="btn btn-success btn-sm" onclick="add_more()">
                                          <i class="fa fa-plus"></i> Add</button>
                                          
                         @php 
                           $loop_count_num=1;
                         @endphp

                         @if(count($productAttrArr)>0)

                         @foreach($productAttrArr as $key=>$val)

                           <input id="paid" type="hidden" name="paid[]" value="{{$val->id}}">
                           <div class="card" id="product_attr_{{$loop_count_num++}}">
                              <div class="card-body">
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-md-2">
                                          <label for="sku" class="control-label mb-1"> SKU</label>
                                          <input id="sku" name="sku[]" value="{{$val->sku}}" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                       </div>
                                       <div class="col-md-2">
                                          <label for="mrp" class="control-label mb-1"> MRP</label>
                                          <input id="mrp" name="mrp[]" value="{{$val->mrp}}" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                       </div>
                                       <div class="col-md-2">
                                          <label for="price" class="control-label mb-1"> Price</label>
                                          <input id="price" name="price[]" value="{{$val->price}}" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                       </div>
                                       <div class="col-md-3">
                                          <label for="size_id" class="control-label mb-1"> Size</label>
                                          <select id="size_id" name="size_id[]" class="form-control">
                                             <option value="">Select</option>
                                             @foreach($sizes as $list)
                                             @if($val->size_id==$list->id)
                                             <option value="{{$list->id}}" selected>{{$list->size}}</option>
                                             @else
                                             <option value="{{$list->id}}">{{$list->size}}</option>
                                             @endif
                                             @endforeach
                                          </select>
                                       </div>
                                       <div class="col-md-3">
                                          <label for="color_id" class="control-label mb-1"> Color</label>
                                          <select id="color_id" name="color_id[]" class="form-control">
                                             <option value="">Select</option>
                                             @foreach($colors as $list)
                                             @if($val->color_id==$list->id)
                                             <option value="{{$list->id}}" selected>{{$list->color}}</option>
                                             @else
                                             <option value="{{$list->id}}">{{$list->color}}</option>
                                             @endif
                                             @endforeach
                                          </select>
                                       </div>
                                       <div class="col-md-2">
                                          <label for="qty" class="control-label mb-1"> Qty</label>
                                          <input id="qty" name="qty[]" value="{{$val->qty}}" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                       </div>
                                       <div class="col-md-4">
                                          <label for="attr_image" class="control-label mb-1"> Image</label>
                                          <input id="attr_image" name="attr_image[]" value="{{$val->sku}}" type="file" class="form-control" aria-required="true" aria-invalid="false" >
                                          
                                          @if($val->attr_image!='')
                                             <img width="100px" src="{{asset('public/uploads/'.$val->attr_image)}}"/>
                                          @endif

                                       </div>
                                       <div class="col-md-2">
                                          
                                          <br>
                                          <a href="{{url('admin/product/product_attr_delete/')}}/{{$val->id}}/{{$id}}"  class="btn btn-sm btn-danger"><i class="fa fa-minus"></i>&nbsp; Remove</a>
                                          
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>

                           @endforeach
                           @else

                           <input id="paid" type="hidden" name="paid[]" value="">
                           <div class="card" id="product_attr_0">
                              <div class="card-body">
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-md-2">
                                          <label for="sku" class="control-label mb-1"> SKU</label>
                                          <input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                       </div>
                                       <div class="col-md-2">
                                          <label for="mrp" class="control-label mb-1"> MRP</label>
                                          <input id="mrp" name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                       </div>
                                       <div class="col-md-2">
                                          <label for="price" class="control-label mb-1"> Price</label>
                                          <input id="price" name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                       </div>
                                       <div class="col-md-3">
                                          <label for="size_id" class="control-label mb-1"> Size</label>
                                          <select id="size_id" name="size_id[]" class="form-control">
                                             <option value="">Select</option>
                                             @foreach($sizes as $list)
                              
                                             <option value="{{$list->id}}">{{$list->size}}</option>
                                             
                                             @endforeach
                                          </select>
                                       </div>
                                       <div class="col-md-3">
                                          <label for="color_id" class="control-label mb-1"> Color</label>
                                          <select id="color_id" name="color_id[]" class="form-control">
                                             <option value="">Select</option>
                                             @foreach($colors as $list)
                                             
                                             <option value="{{$list->id}}">{{$list->color}}</option>
                                             
                                             @endforeach
                                          </select>
                                       </div>
                                       <div class="col-md-2">
                                          <label for="qty" class="control-label mb-1"> Qty</label>
                                          <input id="qty" name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                       </div>
                                       <div class="col-md-4">
                                          <label for="attr_image" class="control-label mb-1"> Image</label>
                                          <input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false" >
                                          
                                         

                                       </div>
                                       <div class="col-md-2">
                                          
                                          <br>
                                          
                                          
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>

                           @endif

                        </div>
                     </div>
                     

                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                        Submit
                        </button>
                     
                     <input type="hidden" name="id" value="{{$id}}"/>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<script>
   var loop_count=50; 
   function add_more(){
       loop_count++;
       var html='<input id="paid" type="hidden" name="paid[]" value="0"><div class="card" id="product_attr_'+loop_count+'"><div class="card-body"><div class="form-group"><div class="row">';
   
       html+='<div class="col-md-2"><label for="sku" class="control-label mb-1"> SKU</label><input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>'; 
   
       html+='<div class="col-md-2"><label for="mrp" class="control-label mb-1"> MRP</label><input id="mrp" name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>'; 
   
       html+='<div class="col-md-2"><label for="price" class="control-label mb-1"> Price</label><input id="price" name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';
   
       var size_id_html=jQuery('#size_id').html(); 
       size_id_html = size_id_html.replace("selected", "");
       html+='<div class="col-md-3"><label for="size_id" class="control-label mb-1"> Size</label><select id="size_id" name="size_id[]" class="form-control">'+size_id_html+'</select></div>';
   
       var color_id_html=jQuery('#color_id').html(); 
       color_id_html = color_id_html.replace("selected", "");
       html+='<div class="col-md-3"><label for="color_id" class="control-label mb-1"> Color</label><select id="color_id" name="color_id[]" class="form-control" >'+color_id_html+'</select></div>';
   
       html+='<div class="col-md-2"><label for="qty" class="control-label mb-1"> Qty</label><input id="qty" name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';
   
       html+='<div class="col-md-4"><label for="attr_image" class="control-label mb-1"> Image</label><input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false" ></div>';
   
       html+='<div class="col-md-2"><br><button type="button" class="btn btn-danger" onclick=remove_more("'+loop_count+'")><i class="fa fa-minus"></i>&nbsp; Remove</button></div>'; 
   
       html+='</div></div></div></div>';
   
       jQuery('#product_attr_box').append(html)
   }
   
   function remove_more(loop_count){
        jQuery('#product_attr_'+loop_count).remove();
   }
   
   var loop_image_count=1; 
   function add_image_more(){
      loop_image_count++;
      var html='<input id="piid" type="hidden" name="piid[]" value=""><div class="col-md-4 product_images_'+loop_image_count+'"><label for="images" class="control-label mb-1"> Image</label><input id="images" name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false" ></div>';
      //product_images_box
       html+='<div class="col-md-2 product_images_'+loop_image_count+'""><label for="attr_image" class="control-label mb-1"> &nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-danger" onclick=remove_image_more("'+loop_image_count+'")><i class="fa fa-minus"></i>&nbsp; Remove</button></div>'; 
       jQuery('#product_images_box').append(html)
   }
   
   function remove_image_more(loop_image_count){
        jQuery('.product_images_'+loop_image_count).remove();
   }

   CKEDITOR.replace('short_desc');
   CKEDITOR.replace('desc');
   CKEDITOR.replace('technical_specification');
</script>
@endsection