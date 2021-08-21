<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$result['data'] = Purchase::All();
        return view('admin.purchase.all', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.purchase.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $request->validate([
            'purchase_date' => 'required',
			'invoice_no' => 'required',
			'company_name' => 'required',
            'total_amount' => 'required'
        ]);

        $model = new Purchase;
        $model->purchase_date = $request->post('purchase_date');
        $model->invoice_no = $request->post('invoice_no');
		$model->company_name = $request->post('company_name');
		$model->total_amount = $request->post('total_amount');
        $model->status = 1;
        $model->save();

        $request->session()->flash('msg', 'Record Added Successful');
        return redirect('admin/purchase/all');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $data = Purchase::where(['id'=>$id])->get();
       
        $result['purchase_date'] = $data[0]->purchase_date;
        $result['invoice_no'] = $data[0]->invoice_no;
		$result['company_name'] = $data[0]->company_name;
		$result['total_amount'] = $data[0]->total_amount;
        $result['purchase_id'] = $data[0]->id;
        return view('admin.purchase.edit', $result);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        $request->validate([
            'purchase_date' => 'required',
            'invoice_no' => 'required',
			'company_name' => 'required',
			'total_amount' => 'required'
        ]);

        $model = Purchase::find($request->post('purchase_id'));
        $model->purchase_date = $request->post('purchase_date');
        $model->company_name = $request->post('company_name');
		$model->invoice_no = $request->post('invoice_no');
		$model->total_amount = $request->post('total_amount');
        $model->save();

        $request->session()->flash('msg', 'Record Updated Successful');
        return redirect('admin/purchase/all');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $model = Purchase::find($id);
        $model->delete();

        $request->session()->flash('msg', 'Record Deleted Successful');
        
        return redirect('admin/purchase/all');
    }



    public function status(Request $request, $id, $status)
    {
        $model = Purchase::find($id);
        $model->status = $status;
        $model->save();

        $request->session()->flash('msg', 'Status updated Successful');
        
        return redirect('admin/purchase/all');
    }
}
