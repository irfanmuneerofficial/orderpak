<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Models\Vendor;
use Hash;
use DB;

class VendorResetPasswordController extends Controller
{
    public function getPassword($token) 
    {
        // print_r('sda');die;
       return view('auth.passwords.vendor_reset', ['token' => $token]);
    }

    public function updatePassword(Request $request)
    {
        
        $request->validate([
            // 'email' => 'required|personal_email|exist:vendors',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',

        ]);

        $updatePassword = DB::table('password_resets')
                            ->where(['email' => $request->personal_email, 'token' => $request->token])
                            ->first();
        // print_r($updatePassword);die;
        if(!$updatePassword)
            return back()->withInput()->with('error', 'Invalid token!');

          $user = Vendor::where('business_email', $request->personal_email)
                      ->update(['password' => Hash::make($request->password)]);
        //   print_r($user);die;
          DB::table('password_resets')->where(['email'=> $request->personal_email])->delete();

          return redirect('/vendor/login')->with('message', 'Your password has been changed!');

    }
}
