<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use DB; 
use Carbon\Carbon; 
use App\Models\User;
use App\Models\Admin; 
use Mail; 
use Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /**
       * Write code on Method
       *
       * @return response()
       */
      public function showForgetPasswordForm()
      {
         return view('admin.auth.forgetPassword');
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:admins',
          ]);
  
          $token = Str::random(64);
  
          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
  
          Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });

          $result = Admin::where('email',$request->email)->first();
          $request->session()->put('FORGOT_PASSWORD_USER_EMAIL',$result->email);
  
          return back()->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($token) { 
         return view('admin.auth.forgetPasswordLink', ['token' => $token]);
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
          
          
          $request->validate([
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);

          $email = $request->session()->get('FORGOT_PASSWORD_USER_EMAIL');
  
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $email, 
                                'token' => $request->token
                              ])
                              ->first();
                                               
          if(!$updatePassword){
            
              return back()->withInput()->with('error', 'Invalid token!');
          }
  
          $user = Admin::where(['email'=>$email])
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['email'=> $email])->delete();
          
          return redirect('/admin')->with('message', 'Your password has been changed!');
      }
}
