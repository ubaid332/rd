<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data']=DB::table('orders')
        ->select('orders.*','orders_status.orders_status')
        ->leftJoin('orders_status','orders_status.id','=','orders.order_status')
        ->get(); 
		 
         return view('admin.order.all', $result);
    }

    public function order_detail(Request $request,$id)
    {
        $result['orders_details']=
                DB::table('orders_details')
                ->select('orders.*','orders_details.price','orders_details.qty','products.name as pname','products_attr.attr_image','sizes.size','colors.color','orders_status.orders_status')
                ->leftJoin('orders','orders.id','=','orders_details.orders_id')
                ->leftJoin('products_attr','products_attr.id','=','orders_details.products_attr_id')
                ->leftJoin('products','products.id','=','products_attr.products_id')
                ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftJoin('orders_status','orders_status.id','=','orders.order_status')
                ->leftJoin('colors','colors.id','=','products_attr.color_id')
                ->where(['orders.id'=>$id])
                ->get();

        $result['orders_status']=
            DB::table('orders_status')
            ->get();
        $result['payment_status']=['Pending','Success','Fail'];      
        return view('admin.order.order_detail',$result);
    } 


    public function update_payemnt_status(Request $request,$status,$id)
    {
        DB::table('orders')
        ->where(['id'=>$id])
        ->update(['payment_status'=>$status]);
        return redirect('/admin/order_detail/'.$id);
    } 

    public function update_order_status(Request $request,$status,$id)
    {
        DB::table('orders')
        ->where(['id'=>$id])
        ->update(['order_status'=>$status]);
        return redirect('/admin/order_detail/'.$id);
    } 

    public function update_track_detail(Request $request,$id)
    {
        $track_details=$request->post('track_details');
        DB::table('orders')
        ->where(['id'=>$id])
        ->update(['track_details'=>$track_details]);
        return redirect('/admin/order_detail/'.$id);
    } 


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$result['customers'] = DB::table('customers')->where(['status'=>1])->get();
        return view('admin.order.create', $result);
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
			'order_date' => 'required',
			'order_detail' => 'required',
			'order_type' => 'required',
		    'customer_id' => 'required',
		    'total_amount' => 'required',
		    'advance_amount' => 'required',
			
		]);
		$model = new order;
        $model->order_date = $request->post('order_date');
		$model->order_detail = $request->post('order_detail');
		$model->order_type = $request->post('order_type');
		$model->customer_id = $request->post('customer_id');
        $model->total_amount = $request->post('total_amount');
		$model->advance_amount = $request->post('advance_amount');
        $model->status = 1;
        $model->save();

        $request->session()->flash('msg', 'Record Added Successful');
        return redirect('admin/order/all');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
		$result['customers'] = DB::table('customers')->where(['status'=>1])->get();
        $data = Order::where(['id'=>$id])->get();
       
        $result['order_date'] = $data[0]->order_date;
		$result['order_detail'] = $data[0]->order_detail;
		$result['order_type'] = $data[0]->order_type;
		$result['customer_id'] = $data[0]->customer_id;
        $result['total_amount'] = $data[0]->total_amount;
		$result['advance_amount'] = $data[0]->advance_amount;
        $result['order_id'] = $data[0]->id;
        return view('admin.order.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'order_date' => 'required',
			'order_detail' =>   'required',
			'order_type' => 'required',
			'customer_id' => 'required',
            'total_amount' => 'required',
			'advance_amount' => 'required',
        ]);

        $model = Order::find($request->post('order_id'));
        $model->order_date = $request->post('order_date');
		$model->order_detail = $request->post('order_detail');
		$model->order_type = $request->post('order_type');
		$model->customer_id = $request->post('customer_id');
        $model->total_amount = $request->post('total_amount');
		$model->advance_amount = $request->post('advance_amount');
        $model->save();

        $request->session()->flash('msg', 'Record Updated Successful');
        return redirect('admin/order/all');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $model = Order::find($id);
        $model->delete();

        $request->session()->flash('msg', 'Record Deleted Successful');
        
        return redirect('admin/order/all');
    }

	 public function status(Request $request, $id, $status)
    {
        $model = Order::find($id);
        $model->status = $status;

        $model->save();

        $request->session()->flash('msg', 'Status updated Successful');
        
        return redirect('admin/order/all');
    }
}
