<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = Brand::All();
        return view('admin.brand.list', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        // validate inputs
        $request->validate([
            'title' => 'required',
            'value' => 'required',
            'code' => 'required|unique:brands',
            ]);

        $model = new Brand();
		
		 if($request->hasfile('image')){
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time().".$ext";
            $image->move(public_path('brands'), $image_name);
            //$image->storeAs('/public/media',$image_name);
            $model->image = $image_name;
        }
		
        $model->name = $request->post('name');
        $model->is_home=0;
        if($request->post('is_home')!==null){
            $model->is_home=1;
        }
		$model->status = 1;
        $model->save();

        $request->session()->flash('msg','Record Added Successfully');
        return redirect('admin/brand/list');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $data = Brand::where(['id'=>$id])->get();
        $result['brand_id'] = $data[0]->id;
        $result['name'] = $data[0]->name;
		$result['image'] = $data[0]->image;
        $result['is_home_selected']="";
        if($data['0']->is_home==1){
            $result['is_home_selected']="checked";
        }
        return view('admin.brand.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        // validate inputs
        $request->validate([
            'name' => 'required'
            ]);

        $model = Brand::find($request->post('brand_id'));

        if($request->hasfile('image')){
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time().".$ext";
            $image->move(public_path('brands'), $image_name);
            //$image->storeAs('/public/media',$image_name);
            $model->image = $image_name;
        }

        $model->name = $request->post('name');
        $model->is_home=0;
        if($request->post('is_home')!==null){
            $model->is_home=1;
        }
        $model->save();

        $request->session()->flash('msg','Record Updated Successfully');
        return redirect('admin/brand/list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $model = Brand::find($id);
        $model->delete();

        $request->session()->flash('msg','Record Deleted Successfully');
        return redirect('admin/brand/list');
    }
	public function status($status,$id){
        $model=Brand::find($id);
        $model->status=$status;
        $model->save();
		session()->flash('msg', 'Status updated Successful');
        return redirect('admin/brand/list');
    }
}
