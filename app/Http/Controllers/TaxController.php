<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
             $result['data'] = Tax::All();
        return view('admin.tax.list', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.tax.create');
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
            'tax_desc' => 'required',
            'tax_value' => 'required',
            ]);

        $model = new Tax();
        $model->tax_desc = $request->post('tax_desc');
        $model->tax_value = $request->post('tax_value');
		$model->status = 1;
        $model->save();

        $request->session()->flash('msg','Record Added Successfully');
        return redirect('admin/tax/list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function show(Tax $tax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
       public function edit(Request $request, $id)
    {
        $data = Tax::where(['id'=>$id])->get();
        $result['id'] = $data[0]->id;
        $result['tax_desc'] = $data[0]->tax_desc;
        $result['tax_value'] = $data[0]->tax_value;
        return view('admin.tax.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
   public function update(Request $request, Tax $tax)
    {
        // validate inputs
        $request->validate([
            'tax_desc' => 'required',
            'tax_value' => 'required',
            ]);

        $model = Tax::find($request->post('id'));
        $model->tax_desc = $request->post('tax_desc');
        $model->tax_value = $request->post('tax_value');
        $model->save();

        $request->session()->flash('msg','Record Updated Successfully');
        return redirect('admin/tax/list');
    }
	
	  public function delete(Request $request, $id)
    {
        $model = Tax::find($id);
        $model->delete();

        $request->session()->flash('msg','Record Deleted Successfully');
        return redirect('admin/tax/list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
 	public function status($status,$id){
        $model=Tax::find($id);
        $model->status=$status;
        $model->save();
		session()->flash('msg', 'Status updated Successful');
        return redirect('admin/tax/list');
    }
}
