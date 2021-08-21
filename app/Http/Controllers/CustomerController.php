<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$result['data'] = Customer::All();
        return view('admin.customer.list', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//		$result['categories'] = DB::table('categories')->where(['status'=>1])->get();
		
        return view('admin.customer.create');
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
			'name' => 'required',
			'father_name' => 'required',
			'cnic' => 'required|unique:customers',
			'address' => 'required',
		    'mobile' => 'required',
		    'email' => 'required'
		   
		]);
			$model = new customer;

        if($request->hasfile('image')){
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time().".$ext";
            $image->storeAs('/public/media',$image_name);
            $model->image = $image_name;
        }

        $model->name = $request->post('name');
		$model->father_name = $request->post('father_name');
        $model->email = $request->post('email');
        $model->mobile = $request->post('mobile');
		$model->cnic = $request->post('cnic');
		$model->address = $request->post('address');
		$model->city = $request->post('city');
        $model->state = $request->post('state');
		$model->status = 1;
        $model->save();

        $request->session()->flash('msg', 'Record Added Successful');
        return redirect('admin/customer/list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
     public function edit(Request $request, $id)
    {
        $data = customer::where(['id'=>$id])->get();
       
        $result['name'] = $data[0]->name;
		$result['father_name'] = $data[0]->father_name;
		$result['cnic'] = $data[0]->cnic;
		$result['address'] = $data[0]->address;
        $result['mobile'] = $data[0]->mobile;
        $result['email'] = $data[0]->email;
        $result['city'] = $data[0]->city;
        $result['state'] = $data[0]->state;
		$result['customer_id'] = $data[0]->id;
		 $result['image'] = $data[0]->image;
        return view('admin.customer.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
		$customer_id = $request->post('customer_id');
		
        $request->validate([
            'name' => 'required',
            'father_name' => 'required',
            'cnic' => 'required|unique:customers',
            'address' => 'required',
            'mobile' => 'required',
            'email' => 'required'
			
        ]);
		 $model = Customer::find($customer_id);
            
        if($request->hasfile('image')){
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media',$image_name);
            $model->image=$image_name;
		}
        
        $model->name = $request->post('name');
        $model->father_name = $request->post('father_name');
        $model->email = $request->post('email');
        $model->mobile = $request->post('mobile');
        $model->cnic = $request->post('cnic');
        $model->address = $request->post('address');
        $model->city = $request->post('city');
        $model->state = $request->post('state');
        $model->save();

        $request->session()->flash('msg', 'Record Updated Successful');
        return redirect('admin/customer/list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $model = Customer::find($id);
        $model->delete();

        $request->session()->flash('msg', 'Record Deleted Successful');
        
        return redirect('admin/customer/list');
    }
	
	public function status(Request $request, $id, $status)
    {
        $model = Customer::find($id);
        $model->status = $status;

        $model->save();

        $request->session()->flash('msg', 'Status updated Successful');
        
        return redirect('admin/customer/list');
    }
}
