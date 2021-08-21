<?php

namespace App\Http\Controllers;

use App\Models\PaymentInstallments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentInstallmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($order_id)
    {
        $data = DB::table('payment_installments')->where(['order_id'=>$order_id])->get();
        foreach($data as $row):
            $status = ($row->status==0)?"<span style='background:red; color:#FFF; padding:5px'>Pending</span>":"<span style='background:green; color:#FFF; padding:5px'>Verified</span>";
            echo "<tr>
	                    <td>$row->id</td>
	
						<td>$row->date</td>

                        <td>$row->detail</td>

                        <td>$row->amount</td>

                        <td>$status</td>
	                    
						
	                </tr>";
        endforeach;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all($order_id)
    {
        $data['installments'] = DB::table('payment_installments')->where(['order_id'=>$order_id])->get();
        return view('admin.order.installments', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arr=[
            "date"=>$request->date,
            "detail"=>$request->detail,
            "amount"=>$request->amount,
            "order_id"=>$request->order_id,
            "status"=>0,
            "created_at"=>date('Y-m-d h:i:s'),
            "updated_at"=>date('Y-m-d h:i:s')
        ];
        $query=DB::table('payment_installments')->insert($arr);
        if($query){

            return response()->json(['status'=>'success','msg'=>"Record Added Successfully"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentInstallments  $paymentInstallments
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentInstallments $paymentInstallments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentInstallments  $paymentInstallments
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentInstallments $paymentInstallments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentInstallments  $paymentInstallments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentInstallments $paymentInstallments)
    {
        //
    }

    public function status(Request $request,$status,$id, $order_id ){
        $model=PaymentInstallments::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Status updated');
        return redirect("admin/order_installments/$order_id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentInstallments  $paymentInstallments
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentInstallments $paymentInstallments)
    {
        //
    }
}
