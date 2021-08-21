<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $result['data']=Color::all();
        return view('admin/color/color_list',$result);
    }

    
    public function create(Request $request)
    {

        return view('admin/color/color_create');
    }

    public function edit(Request $request,$id='')
    {
        if($id>0){
            $arr=Color::where(['id'=>$id])->get(); 

            $result['color']=$arr['0']->color;
            $result['status']=$arr['0']->status;
            $result['id']=$arr['0']->id;
        }else{
            $result['color']='';
            $result['status']='';
            $result['id']=0;
            
        }
        return view('admin/color/color_edit',$result);
    }

    public function save(Request $request)
    {
        //return $request->post();
        
        $request->validate([
            'color'=>'required|unique:colors,color,'.$request->post('id'),   
        ]);

        
        $model=new Color();
        
        $model->color=$request->post('color');
        $model->status=1;
        $model->save();
        $request->session()->flash('message',"Color inserted");
        return redirect('admin/color/list');
        
    }

    public function update(Request $request)
    {
        //return $request->post();
        
        $request->validate([
            'color'=>'required|unique:colors,color,'.$request->post('id'),   
        ]);

        
        $model=Color::find($request->post('id'));
        
        $model->color=$request->post('color');
        $model->status=1;
        $model->save();
        $request->session()->flash('message',"Color updated");
        return redirect('admin/color/list');
        
    }

    public function delete(Request $request,$id){
        $model=color::find($id);
        $model->delete();
        $request->session()->flash('message','Color deleted');
        return redirect('admin/color/list');
    }

    public function status(Request $request,$status,$id){
        $model=Color::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Color status updated');
        return redirect('admin/color/list');
    }
}
