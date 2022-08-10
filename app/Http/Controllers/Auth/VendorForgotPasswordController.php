<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Vendor;
use DB;
use Carbon\Carbon;
use Mail;


class VendorForgotPasswordController extends Controller
{
	public function getEmail()
    {
       return view('auth.passwords.vendor_email');
    }

    public function postEmail(Request $request)
    {
      // dd(request()->all());
      $vendor = Vendor::where('business_email',request('email'))->first();
      if($vendor){

    	// $request->validate([
     //        'personal_email' => 'required|personal_email|exists:vendors',
     //    ]);

        $token = Str::random(60);

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::send('auth.vendor_verify',['token' => $token], function($message) use ($request) {
                  $message->from('noreply@orderpak.com');
                  $message->to($request->email);
                  $message->subject('Reset Password Notification');
               });

        return back()->with('message', 'We have e-mailed your password reset link!');
      } 
      else
        return back()->with('error', 'This Email is Not Register in Our Record!');

    }
}
