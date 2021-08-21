<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = Coupon::All();
        return view('admin.coupons.coupon_list', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupons.coupon_create');
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
            'code' => 'required|unique:coupons',
            ]);

        $model = new Coupon();
        $model->title=$request->post('title');
        $model->code=$request->post('code');
        $model->value=$request->post('value');
        $model->type=$request->post('type');
        $model->min_order_amt=$request->post('min_order_amt');
        $model->is_one_time=$request->post('is_one_time');
        $model->status=1;
        $model->save();

        $request->session()->flash('msg','Record Added Successfully');
        return redirect('admin/coupon/list');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $data = Coupon::where(['id'=>$id])->get();
        $result['coupon_id'] = $data[0]->id;
        $result['title'] = $data[0]->title;
        $result['code'] = $data[0]->code;
        $result['value'] = $data[0]->value;
        $result['type']=$data['0']->type;
        $result['min_order_amt']=$data['0']->min_order_amt;
        $result['is_one_time']=$data['0']->is_one_time;
        return view('admin.coupons.coupon_edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, coupon $coupon)
    {
        // validate inputs
        $request->validate([
            'title' => 'required',
            'value' => 'required',
            'code' => 'required|unique:coupons,code,'.$request->post('coupon_id'),
            ]);

        $model = Coupon::find($request->post('coupon_id'));
        $model->title = $request->post('title');
        $model->code = $request->post('code');
        $model->value = $request->post('value');
        $model->type=$request->post('type');
        $model->min_order_amt=$request->post('min_order_amt');
        $model->is_one_time=$request->post('is_one_time');
        $model->save();

        $request->session()->flash('msg','Record Updated Successfully');
        return redirect('admin/coupon/list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $model = Coupon::find($id);
        $model->delete();

        $request->session()->flash('msg','Record Deleted Successfully');
        return redirect('admin/coupon/list');
    }

    public function status(Request $request,$status,$id){
        $model=Coupon::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Coupon status updated');
        return redirect('admin/coupon/list');
    }
}
