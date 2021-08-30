<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = Category::All();
        return view('admin.categories.category_list', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $result['category']=DB::table('categories')->where(['status'=>1])->get();
        return view('admin.categories.category_create', $result);
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
            'category_name' => 'required|max:20|alpha_spaces',
            'category_slug' => 'required|unique:categories',
            'image' => 'required',
            ]);

        $model = new Category();

        if($request->hasfile('image')){
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->move(public_path('uploads'), $image_name);
            $model->category_image=$image_name;
        }

        $model->category_name = $request->post('category_name');
        $model->category_slug = $request->post('category_slug');
        $model->parent_category_id=$request->post('parent_category_id');
        $model->is_home=0;
        if($request->post('is_home')!==null){
            $model->is_home=1;
        }
        $model->status=1;
        $model->save();

        $request->session()->flash('msg','Record Added Successfully');
        return redirect('admin/category/list');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $result['category']=DB::table('categories')->where(['status'=>1])->get();
        $data = Category::where(['id'=>$id])->get();
        $result['cat_id'] = $data[0]->id;
        $result['category_name'] = $data[0]->category_name;
        $result['category_slug'] = $data[0]->category_slug;
        $result['parent_category_id'] = $data[0]->parent_category_id;
        $result['category_image'] = $data[0]->category_image;
        $result['is_home_selected']="";
            if($data['0']->is_home==1){
                $result['is_home_selected']="checked";
            }
        return view('admin.categories.category_edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        // validate inputs
        $request->validate([
            'category_name' => 'required',
            'category_slug' => 'required|unique:categories,category_slug,'.$request->post('cat_id'),
            ]);
        $model = Category::find($request->post('cat_id'));

        if($request->hasfile('image')){
            // Delete existing File
            if(File::exists('public/uploads/'.$model->category_image)){
                File::delete('public/uploads/'.$model->category_image);
            }

            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->move(public_path('uploads'), $image_name);
            $model->category_image=$image_name;
        }
        
        $model->category_name = $request->post('category_name');
        $model->category_slug = $request->post('category_slug');
        $model->parent_category_id=$request->post('parent_category_id');
        if($request->post('is_home')!==null){
            $model->is_home=1;
        }
        else
        {
            $model->is_home=0;
        }
        $model->save();

        $request->session()->flash('msg','Record Updated Successfully');
        return redirect('admin/category/list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $model = Category::find($id);

        // Delete existing File
        if(File::exists('public/uploads/'.$model->category_image)){
            File::delete('public/uploads/'.$model->category_image);
        }

        $model->delete();

        $request->session()->flash('msg','Record Deleted Successfully');
        return redirect('admin/category/list');
    }

    public function status(Request $request,$status,$id){
        $model=Category::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('msg','Status updatd Successfully');
        return redirect('admin/category/list');
    }
}
