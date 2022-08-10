<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class CustomLoginController extends Controller
{
    public function LoginUser(Request $request)
    {
    	$email = $request->email;
    	$password = $request->password;

    	if(Auth::attempt(['email'=> $email, 'password' => $password])){
    		$msg = array(
    			'status' => 'success', 
    			'message' => 'Login Successful', 
    		);
    		return response()->json($msg);
    	}
    	else{
    		$msg = array(
    			'status' => 'error' , 
    			'message' => 'These credentials do not match our records.' , 
    		);
    		return response()->json($msg);
    	}
    }
}
