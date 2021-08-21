<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $result['data']=Size::all();
        return view('admin/sizes/size_list',$result);
    }

    
    public function create(Request $request)
    {
    
        return view('admin/sizes/size_create');
    }

    public function edit(Request $request,$id)
    {
            $arr=Size::where(['id'=>$id])->get();
            $result['size']=$arr['0']->size;
            $result['status']=$arr['0']->status;
            $result['id']=$arr['0']->id;
        
        return view('admin/sizes/size_edit',$result);
    }

    public function save(Request $request)
    {
        //return $request->post();
        
        $request->validate([
            'size'=>'required|unique:sizes,size,'.$request->post('id'),   
        ]);

       
        $model=new Size();
        
        $model->size=$request->post('size');
        $model->status=1;
        $model->save();
        $request->session()->flash('message',"Size inserted");
        return redirect('admin/size/list');
        
    }

    public function update(Request $request)
    {
        //return $request->post();
        
        $request->validate([
            'size'=>'required|unique:sizes,size,'.$request->post('id'),   
        ]);
        
        $model=Size::find($request->post('id'));
        
        $model->size=$request->post('size');
        $model->status=1;
        $model->save();
        $request->session()->flash('message',"Size updated");
        return redirect('admin/size/list');
        
    }

    public function delete(Request $request,$id){
        $model=Size::find($id);
        $model->delete();
        $request->session()->flash('message','Size deleted');
        return redirect('admin/size/list');
    }

    public function status(Request $request,$status,$id){
        $model=Size::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Size status updated');
        return redirect('admin/size/list');
    }
}
