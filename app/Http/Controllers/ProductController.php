<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class ProductController extends Controller
{
    public function index()
    {
        $result['data']=Product::all();
        return view('admin/products/product_list',$result);
    }

    
    public function create(Request $request)
    {

        $result['category']=DB::table('categories')->where(['status'=>1])->get();
        $result['sizes']=DB::table('sizes')->where(['status'=>1])->get();
        $result['colors']=DB::table('colors')->where(['status'=>1])->get();
        $result['brands']=DB::table('brands')->where(['status'=>1])->get();
        $result['taxs']=DB::table('taxs')->where(['status'=>1])->get();
        return view('admin/products/product_create',$result);
    }

    public function edit(Request $request,$id='')
    {
            $arr=Product::where(['id'=>$id])->get(); 

            $result['category_id']=$arr['0']->category_id;
            $result['name']=$arr['0']->name;
            $result['image']=$arr['0']->image;
            $result['slug']=$arr['0']->slug;
            $result['brand']=$arr['0']->brand;
            $result['model']=$arr['0']->model;
            $result['short_desc']=$arr['0']->short_desc;
            $result['desc']=$arr['0']->desc;
            $result['keywords']=$arr['0']->keywords;
            $result['technical_specification']=$arr['0']->technical_specification;
            $result['uses']=$arr['0']->uses;
            $result['warranty']=$arr['0']->warranty;
            $result['lead_time']=$arr['0']->lead_time;
            $result['tax_id']=$arr['0']->tax_id;
            $result['is_promo']=$arr['0']->is_promo;
            $result['is_featured']=$arr['0']->is_featured;
            $result['is_discounted']=$arr['0']->is_discounted;
            $result['is_tranding']=$arr['0']->is_tranding;
            $result['status']=$arr['0']->status;
            $result['id']=$arr['0']->id;
        

        $result['category']=DB::table('categories')->where(['status'=>1])->get();
        $result['sizes']=DB::table('sizes')->where(['status'=>1])->get();
        $result['colors']=DB::table('colors')->where(['status'=>1])->get();
        $result['brands']=DB::table('brands')->where(['status'=>1])->get();
        $result['taxs']=DB::table('taxes')->where(['status'=>1])->get();
        
        $result['productAttrArr']=DB::table('products_attr')->where(['products_id'=>$id])->get();
        $productImagesArr=DB::table('product_images')->where(['products_id'=>$id])->get();
            
        if(!isset($productImagesArr[0])){
            $result['productImagesArr']['0']['id']='';
            $result['productImagesArr']['0']['images']='';
        }else{
            $result['productImagesArr']=$productImagesArr;
        }
        return view('admin/products/product_edit',$result);
    }

    public function save(Request $request)
    {
        //return $request->post();
        // echo "<pre>";
        // print_r($request->post());
        // die();
        
        $image_validation="required|mimes:jpeg,jpg,png";
        
        $request->validate([
            'name'=>'required',
            'image'=>$image_validation,
            'slug'=>'required|unique:products,slug,'.$request->post('id'),   
        ]);

            $model=new Product();
            
    

        if($request->hasfile('image')){
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media',$image_name);
            $model->image=$image_name;
        }

        $model->category_id=$request->post('category_id');
        $model->name=$request->post('name');
        $model->slug=$request->post('slug');
        $model->brand=$request->post('brand');
        $model->model=$request->post('model');
        $model->short_desc=$request->post('short_desc');
        $model->desc=$request->post('desc');
        $model->keywords=$request->post('keywords');
        $model->technical_specification=$request->post('technical_specification');
        $model->uses=$request->post('uses');
        $model->warranty=$request->post('warranty');
        $model->lead_time=$request->post('lead_time');
        $model->tax_id=$request->post('tax_id');
        $model->is_promo=$request->post('is_promo');
        $model->is_featured=$request->post('is_featured');
        $model->is_discounted=$request->post('is_discounted');
        $model->is_tranding=$request->post('is_tranding');
        $model->status=1;
        $model->save();

        $pid=$model->id;

        $skuArr=$request->post('sku'); 
        $mrpArr=$request->post('mrp'); 
        $priceArr=$request->post('price'); 
        $qtyArr=$request->post('qty'); 
        $size_idArr=$request->post('size_id'); 
        $color_idArr=$request->post('color_id');

        /*Product Attr Start*/ 
        foreach($skuArr as $key=>$val){
            $productAttrArr['products_id']=$pid;
            $productAttrArr['sku']=$skuArr[$key];
            $productAttrArr['mrp']=$mrpArr[$key];
            $productAttrArr['price']=$priceArr[$key];
            $productAttrArr['qty']=$qtyArr[$key];
            if($size_idArr[$key]==''){
                $productAttrArr['size_id']=0;
            }else{
                $productAttrArr['size_id']=$size_idArr[$key];
            }

            if($color_idArr[$key]==''){
                $productAttrArr['color_id']=0;
            }else{
                $productAttrArr['color_id']=$color_idArr[$key];
            }
            
            if($request->hasFile("attr_image.$key")){
                $rand=rand('111111111','999999999');
                $attr_image=$request->file("attr_image.$key");
                $ext=$attr_image->extension();
                $image_name=$rand.'.'.$ext;
                $request->file("attr_image.$key")->storeAs('/public/media',$image_name);
                $productAttrArr['attr_image']=$image_name;
            }

              
                DB::table('products_attr')->insert($productAttrArr);
            
            
        }


        /*Product Images Start*/
        $piidArr=$request->post('piid'); 
        foreach($piidArr as $key=>$val){
            $productImageArr['products_id']=$pid;
            if($request->hasFile("images.$key")){

                if($piidArr[$key]!=''){ 
                    $arrImage=DB::table('product_images')->where(['id'=>$piidArr[$key]])->get();
                    if(Storage::exists('/public/media/'.$arrImage[0]->images)){
                        Storage::delete('/public/media/'.$arrImage[0]->images);
                    }
                }

                $rand=rand('111111111','999999999');
                $images=$request->file("images.$key");
                $ext=$images->extension();
                $image_name=$rand.'.'.$ext;
                $request->file("images.$key")->storeAs('/public/media',$image_name);
                $productImageArr['images']=$image_name;
                
                if($piidArr[$key]!=''){
                    DB::table('product_images')->where(['id'=>$piidArr[$key]])->update($productImageArr);
                }else{
                    DB::table('product_images')->insert($productImageArr);
                }
                
            }
        }
        
        /*Product Images End*/  

        $request->session()->flash('message',"Product inserted");
        return redirect('admin/product/list');
        
    }

    public function update(Request $request)
    {
        //return $request->post();

        $pid = $request->post('id');
        
        $request->validate([
            'name'=>'required',
            'image'=>'mimes:jpeg,jpg,png',
            'slug'=>'required|unique:products,slug,'.$request->post('id'),
            'attr_image.*' =>'mimes:jpg,jpeg,png',
            'images.*' =>'mimes:jpg,jpeg,png' 
        ]);

        $model=Product::find($pid);
            
        if($request->hasfile('image')){
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media',$image_name);
            $model->image=$image_name;
        }

        $model->category_id=$request->post('category_id');;
        $model->name=$request->post('name');
        $model->slug=$request->post('slug');
        $model->brand=$request->post('brand');
        $model->model=$request->post('model');
        $model->short_desc=$request->post('short_desc');
        $model->desc=$request->post('desc');
        $model->keywords=$request->post('keywords');
        $model->technical_specification=$request->post('technical_specification');
        $model->uses=$request->post('uses');
        $model->warranty=$request->post('warranty');
        $model->lead_time=$request->post('lead_time');
        $model->tax_id=$request->post('tax_id');
        $model->is_promo=$request->post('is_promo');
        $model->is_featured=$request->post('is_featured');
        $model->is_discounted=$request->post('is_discounted');
        $model->is_tranding=$request->post('is_tranding');
        $model->save();

        $paidArr=$request->post('paid'); 
        $skuArr=$request->post('sku'); 
        $mrpArr=$request->post('mrp'); 
        $priceArr=$request->post('price'); 
        $qtyArr=$request->post('qty'); 
        $size_idArr=$request->post('size_id'); 
        $color_idArr=$request->post('color_id');

        /*check if SKU already exist or not*/

        foreach($skuArr as $key=>$val){
            $check=DB::table('products_attr')->
            where('sku','=',$skuArr[$key])->
            where('id','!=',$paidArr[$key])->
            get();

            if(isset($check[0])){
                $request->session()->flash('sku_error',$skuArr[$key].' SKU already used');
                return redirect(request()->headers->get('referer'));
            }
        }

        /*Product Attr Start*/ 
        foreach($skuArr as $key=>$val){
            $productAttrArr['products_id']=$pid;
            $productAttrArr['sku']=$skuArr[$key];
            $productAttrArr['mrp']=$mrpArr[$key];
            $productAttrArr['price']=$priceArr[$key];
            $productAttrArr['qty']=$qtyArr[$key];
            if($size_idArr[$key]==''){
                $productAttrArr['size_id']=0;
            }else{
                $productAttrArr['size_id']=$size_idArr[$key];
            }

            if($color_idArr[$key]==''){
                $productAttrArr['color_id']=0;
            }else{
                $productAttrArr['color_id']=$color_idArr[$key];
            }
            
            if($request->hasFile("attr_image.$key")){
                $rand=rand('111111111','999999999');
                $attr_image=$request->file("attr_image.$key");
                $ext=$attr_image->extension();
                $image_name=$rand.'.'.$ext;
                $request->file("attr_image.$key")->storeAs('/public/media',$image_name);
                $productAttrArr['attr_image']=$image_name;
            }


              if($paidArr[$key]!=0){
                DB::table('products_attr')->where(['id'=>$paidArr[$key]])->update($productAttrArr);
            }else{
                DB::table('products_attr')->insert($productAttrArr);
            }
            
            
        }


         /*Product Images Start*/
        $piidArr=$request->post('piid'); 
        foreach($piidArr as $key=>$val){
            $productImageArr['products_id']=$pid;
            if($request->hasFile("images.$key")){

                if($piidArr[$key]!=''){ 
                    $arrImage=DB::table('product_images')->where(['id'=>$piidArr[$key]])->get();
                    if(Storage::exists('/public/media/'.$arrImage[0]->images)){
                        Storage::delete('/public/media/'.$arrImage[0]->images);
                    }
                }

                $rand=rand('111111111','999999999');
                $images=$request->file("images.$key");
                $ext=$images->extension();
                $image_name=$rand.'.'.$ext;
                $request->file("images.$key")->storeAs('/public/media',$image_name);
                $productImageArr['images']=$image_name;
                
                if($piidArr[$key]!=''){
                    DB::table('product_images')->where(['id'=>$piidArr[$key]])->update($productImageArr);
                }else{
                    DB::table('product_images')->insert($productImageArr);
                }
                
            }
        }
        
        /*Product Images End*/ 

        $request->session()->flash('message',"Product updated successfully");
        return redirect('admin/product/list');
        
    }

    public function delete(Request $request,$id){
        $model=Product::find($id);
        $model->delete();
        $request->session()->flash('message','Product deleted');
        return redirect('admin/product/list');
    }

    public function status(Request $request,$status,$id){
        $model=Product::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Product status updated');
        return redirect('admin/product/list');
    }

    public function product_attr_delete(Request $request,$paid,$pid){
        DB::table('products_attr')->where(['id'=>$paid])->delete();
        return redirect('admin/product/edit/'.$pid);
    }


    public function product_images_delete(Request $request,$paid,$pid){
        $arrImage=DB::table('product_images')->where(['id'=>$paid])->get();
        if(Storage::exists('/public/media/'.$arrImage[0]->images)){
            Storage::delete('/public/media/'.$arrImage[0]->images);
        }
        DB::table('product_images')->where(['id'=>$paid])->delete();
        return redirect('admin/product/edit/'.$pid);
    }
}
