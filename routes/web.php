<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeBannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PurchaseController;       
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\PaymentInstallmentsController;
use App\Http\Controllers\ForgotPasswordController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/cmd', function(){
	$exitCode = Artisan::call('cache:clear');
});




Route::get('/',[FrontController::class,'index']);
Route::get('contact',[FrontController::class,'contact']);
Route::get('category/{id}',[FrontController::class,'category']);
Route::get('product/{id}',[FrontController::class,'product']);
Route::post('add_to_cart',[FrontController::class,'add_to_cart']);
Route::get('cart',[FrontController::class,'cart']);
Route::get('installments/{id}/{amount}',[FrontController::class,'installments']);
Route::get('search/{str}',[FrontController::class,'search']);
Route::get('registration',[FrontController::class,'registration']);
Route::post('registration_process',[FrontController::class,'registration_process'])->name('registration.registration_process');
Route::post('login_process',[FrontController::class,'login_process'])->name('login.login_process');
Route::get('logout', function () {
    session()->forget('FRONT_USER_LOGIN');
    session()->forget('FRONT_USER_ID');
    session()->forget('FRONT_USER_NAME');
    session()->forget('USER_TEMP_ID');
    return redirect('/');
});
Route::get('/verification/{id}',[FrontController::class,'email_verification']);
Route::post('forgot_password',[FrontController::class,'forgot_password']);
Route::get('/forgot_password_change/{id}',[FrontController::class,'forgot_password_change']);
Route::post('forgot_password_change_process',[FrontController::class,'forgot_password_change_process']);
Route::get('/checkout',[FrontController::class,'checkout']);
Route::post('apply_coupon_code',[FrontController::class,'apply_coupon_code']);
Route::post('remove_coupon_code',[FrontController::class,'remove_coupon_code']);
Route::post('place_order',[FrontController::class,'place_order']);
Route::get('/order_placed',[FrontController::class,'order_placed']);
Route::get('/order_fail',[FrontController::class,'order_fail']);
Route::get('/instamojo_payment_redirect',[FrontController::class,'instamojo_payment_redirect']);

Route::post('add_installement',[PaymentInstallmentsController::class,'store']);
Route::get('fetch_installments/{order_id}',[PaymentInstallmentsController::class,'index']);



Route::post('product_review_process',[FrontController::class,'product_review_process']);

Route::group(['middleware'=>'disable_back_btn'],function(){
    Route::group(['middleware'=>'user_auth'],function(){
        Route::get('/order',[FrontController::class,'order']);
        Route::get('/order_detail/{id}',[FrontController::class,'order_detail']);
    });
});

Route::get('admin', [AdminController::class,'index']);
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
Route::post('admin/auth', [AdminController::class,'auth'])->name('admin.auth');

Route::group(['middleware'=>'admin_auth'], function(){
	Route::get('admin/dashboard', [AdminController::class,'dashboard']);
	Route::get('admin/updatePassword', [AdminController::class,'updatePassword']);
	
	Route::get('admin/category/list', [CategoryController::class,'index']);
	Route::get('admin/category/create', [CategoryController::class,'create']);
	Route::get('admin/category/delete/{id}', [CategoryController::class,'delete']);
	Route::get('admin/category/edit/{id}', [CategoryController::class,'edit']);
	Route::post('admin/category/save', [CategoryController::class,'save'])->name('category.save');
	Route::post('admin/category/update', [CategoryController::class,'update'])->name('category.update');
	Route::get('admin/category/status/{status}/{id}',[CategoryController::class,'status']);

	Route::get('admin/product/list', [ProductController::class,'index']);
	Route::get('admin/product/create', [ProductController::class,'create']);
	Route::get('admin/product/delete/{id}', [ProductController::class,'delete']);
	Route::get('admin/product/edit/{id}', [ProductController::class,'edit']);
	Route::post('admin/product/save', [ProductController::class,'save'])->name('product.save');
	Route::post('admin/product/update', [ProductController::class,'update'])->name('product.update');
	Route::get('admin/product/status/{status}/{id}',[ProductController::class,'status']);
	Route::get('admin/product/product_attr_delete/{paid}/{pid}',[ProductController::class,'product_attr_delete']);
	Route::get('admin/product/product_images_delete/{paid}/{pid}',[ProductController::class,'product_images_delete']);

	Route::get('admin/coupon/list', [CouponController::class,'index']);
	Route::get('admin/coupon/create', [CouponController::class,'create']);
	Route::get('admin/coupon/delete/{id}', [CouponController::class,'delete']);
	Route::get('admin/coupon/edit/{id}', [CouponController::class,'edit']);
	Route::post('admin/coupon/save', [CouponController::class,'save'])->name('coupon.save');
	Route::post('admin/coupon/update', [CouponController::class,'update'])->name('coupon.update');
	Route::get('admin/coupon/status/{status}/{id}',[CouponController::class,'status']);

	Route::get('admin/size/list',[SizeController::class,'index']);
    Route::get('admin/size/create',[SizeController::class,'create']);
    Route::get('admin/size/edit/{id}',[SizeController::class,'edit']);
    Route::post('admin/size/save',[SizeController::class,'save'])->name('size.save');
    Route::post('admin/size/update',[SizeController::class,'update'])->name('size.update');
    Route::get('admin/size/delete/{id}',[SizeController::class,'delete']);
    Route::get('admin/size/status/{status}/{id}',[SizeController::class,'status']);

    Route::get('admin/tax/list',[TaxController::class,'index']);
    Route::get('admin/tax/create',[TaxController::class,'create']);
    Route::get('admin/tax/edit/{id}',[TaxController::class,'edit']);
    Route::post('admin/tax/save',[TaxController::class,'save'])->name('tax.save');
    Route::post('admin/tax/update',[TaxController::class,'update'])->name('tax.update');
    Route::get('admin/tax/delete/{id}',[TaxController::class,'delete']);
    Route::get('admin/tax/status/{status}/{id}',[TaxController::class,'status']);

    Route::get('admin/color/list',[ColorController::class,'index']);
    Route::get('admin/color/create',[ColorController::class,'create']);
    Route::get('admin/color/edit/{id}',[ColorController::class,'edit']);
    Route::post('admin/color/save',[ColorController::class,'save'])->name('color.save');
    Route::post('admin/color/update',[ColorController::class,'update'])->name('color.update');
    Route::get('admin/color/delete/{id}',[ColorController::class,'delete']);
    Route::get('admin/color/status/{status}/{id}',[ColorController::class,'status']);

    Route::get('admin/customer/list', [CustomerController::class, 'index']);
	Route::get('admin/customer/create', [CustomerController::class, 'create']);
	Route::get('admin/customer/delete/{id}', [CustomerController::class, 'delete']);
	Route::get('admin/customer/edit/{id}', [CustomerController::class, 'edit']);
	Route::get('admin/customer/status/{id}/{status}', [CustomerController::class, 'status']);
	Route::post('admin/customer/save', [CustomerController::class, 'save'])->name('customer.save');
	Route::post('admin/customer/update', [CustomerController::class, 'update'])->name('customer.update');

	Route::get('admin/brand/list', [BrandController::class, 'index']);
	Route::get('admin/brand/create', [BrandController::class, 'create']);
	Route::get('admin/brand/delete/{id}', [BrandController::class, 'delete']);
	Route::get('admin/brand/edit/{id}', [BrandController::class, 'edit']);
	Route::get('admin/brand/status/{id}/{status}', [BrandController::class, 'status']);
	Route::post('admin/brand/save', [BrandController::class, 'save'])->name('brand.save');
	Route::post('admin/brand/update', [BrandController::class, 'update'])->name('brand.update');

	Route::get('admin/order/list', [OrderController::class, 'index']);
	Route::get('admin/order/create', [OrderController::class, 'create']);
	Route::get('admin/order/delete/{id}', [OrderController::class, 'delete']);
	Route::get('admin/order/edit/{id}', [OrderController::class, 'edit']);
	Route::get('admin/order/status/{id}/{status}', [OrderController::class, 'status']);
	Route::post('admin/order/save', [OrderController::class, 'save'])->name('order.save');
	Route::post('admin/order/update', [OrderController::class, 'update'])->name('order.update');
	Route::get('admin/order_detail/{id}',[OrderController::class,'order_detail']);
	Route::post('admin/order_detail/{id}',[OrderController::class,'update_track_detail']);
    Route::get('admin/update_payemnt_status/{status}/{id}',[OrderController::class,'update_payemnt_status']);
    Route::get('admin/update_order_status/{status}/{id}',[OrderController::class,'update_order_status']);
	Route::get('admin/order_installments/{order_id}',[PaymentInstallmentsController::class,'all']);
	Route::get('admin/order_installments/status/{id}/{status}/{order_id}', [PaymentInstallmentsController::class, 'status']);
		
		
	Route::get('admin/purchase/all', [PurchaseController::class, 'index']);
	Route::get('admin/purchase/create', [PurchaseController::class, 'create']);
	Route::get('admin/purchase/delete/{id}', [PurchaseController::class, 'delete']);
	Route::get('admin/purchase/edit/{id}', [PurchaseController::class, 'edit']);
	Route::get('admin/purchase/status/{id}/{status}', [PurchaseController::class, 'status']);
	Route::post('admin/purchase/save', [PurchaseController::class, 'save'])->name('purchase.save');
	Route::post('admin/purchase/update', [PurchaseController::class, 'update'])->name('purchase.update');

	Route::get('admin/home_banner/list', [HomeBannerController::class,'index']);
	Route::get('admin/home_banner/create', [HomeBannerController::class,'create']);
	Route::get('admin/home_banner/delete/{id}', [HomeBannerController::class,'delete']);
	Route::get('admin/home_banner/edit/{id}', [HomeBannerController::class,'edit']);
	Route::post('admin/home_banner/save', [HomeBannerController::class,'save'])->name('home_banner.save');
	Route::get('admin/home_banner/status/{status}/{id}',[HomeBannerController::class,'status']);
	Route::post('admin/home_banner/update', [HomeBannerController::class,'update'])->name('home_banner.update');

	Route::get('admin/logout', function () {
    session()->forget('ADMIN_LOGIN');
    session()->forget('ADMIN_ID');
    session()->flash('error','Logout sucessfully');
    return redirect('admin');
	});

});
