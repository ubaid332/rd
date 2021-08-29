<?php

namespace App\Http\Controllers;

use App\Models\home_banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = home_banner::All();
        return view('admin.home_banner.list', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.home_banner.create');
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
            'btn_txt' => 'required',
            'btn_link' => 'required'
           /* 'status' => 'required|unique:home_banners',*/
            ]);

        $model = new home_banner();
		
		 if($request->hasfile('image')){
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time().".$ext";
            $image->move(public_path('uploads'), $image_name);
            $model->image = $image_name;
        }
		
        $model->btn_txt = $request->post('btn_txt');
        $model->btn_link = $request->post('btn_link');
		$model->status = 1;
        $model->save();

        $request->session()->flash('msg','Record Added Successfully');
        return redirect('admin/home_banner/list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\home_banner  $home_banner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = home_banner::where(['id'=>$id])->get();
        $result['id'] = $data[0]->id;
        $result['btn_txt'] = $data[0]->btn_txt;
        $result['btn_link'] = $data[0]->btn_link;
		$result['image'] = $data[0]->image;
        return view('admin.home_banner.edit', $result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\home_banner  $home_banner
     * @return \Illuminate\Http\Response
     */
    /*public function edit(home_banner $home_banner)
    {
        //
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\home_banner  $home_banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
		$id = $request->post('id');
		
         // validate inputs
        $request->validate([
            'btn_txt' => 'required',
            'btn_link' => 'required'
            ]);

        $model = home_banner::find($request->post('id'));
		
			
		if($request->hasfile('image')){

            // Delete existing File
            if(File::exists('public/uploads/'.$model->image)){
                File::delete('public/uploads/'.$model->image);
            }

            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->move(public_path('uploads'), $image_name);
            $model->image=$image_name;
		}	
        $model->btn_txt =$request->post('btn_txt');
        $model->btn_link =$request->post('btn_link');
        $model->status=1;
        $model->save();

        $request->session()->flash('msg','Record Updated Successfully');
        return redirect('admin/home_banner/list');
    
	}
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\home_banner  $home_banner
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $model = home_banner::find($id);
        $model->delete();

        session()->flash('msg','Record Deleted Successfully');
        return redirect('admin/home_banner/list');
    }
	
	public function status($status,$id)
    {
        $model = home_banner::find($id);

        // Delete existing File
        if(File::exists('public/uploads/'.$model->image)){
            File::delete('public/uploads/'.$model->image);
        }

        $model->status = $status;

        $model->save();

        session()->flash('msg', 'Status updated Successful');
        
        return redirect('admin/home_banner/list');
    }


}
