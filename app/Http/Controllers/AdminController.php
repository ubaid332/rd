<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Crypt;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session()->has('ADMIN_LOGIN'))
        {
            return redirect('admin/dashboard');
        }

        return view('admin.login');
    }

    
    public function auth(Request $request)
    {
        $this->validate($request, [
            'email'     =>      'required|email',
            'password'  =>      'required|alphaNum|min:3'
        ]);
        
        $user_data = array(
            'email'     =>      $request->get('email')
        );        

        $result = Admin::where($user_data)->first();
       
        if(Hash::check($request->get('password'), $result->password))
        {
            
            $request->session()->put('ADMIN_LOGIN',true);
            $request->session()->put('ADMIN_ID',$result->id);
            return redirect('admin/dashboard');
              
        }
        else
        {
            $request->session()->flash('error','Enter correct login detail');
            return redirect('admin');
        }
    }

    public function dashboard()
    {
        $data['active_categories'] = Category::where('status',  1)->get()->count();
        $data['active_products'] = Product::where('status',  1)->get()->count();
        $data['active_customers'] = Customer::where('status',  1)->get()->count();
        $data['delivered_orders'] = Order::where('order_status',  3)->get()->count();
        $data['on_the_way_orders'] = Order::where('order_status',  2)->get()->count();
        $data['placed_orders'] = Order::where('order_status',  1)->get()->count();
        return view('admin.dashboard',$data);
    }

    // public function updatePassword(Request $r)
    // {
    //     $r = Admin::find(1);
    //     $r->Password = Hash::make('12345');
    //     $r->Save();
    // }


}
