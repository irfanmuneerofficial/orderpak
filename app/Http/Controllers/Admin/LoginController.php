<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;

class LoginController extends Controller
{
	public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function index()
    {
    	return view('admin.auth.login');
    }

    public function Login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email,'is_admin' => true, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended('/admin/dashboard');
        }
        else{
            return back()->withErrors(['invalid' => 'Invalid your Email or Password']);
        }
    }
    
    public function add(Request $request)
    {
        $user = new User;
        $user->fullname = 'jhon';
        $user->email = 'jhon@gmail.com';
        $user->phone = '8789712397';
        $user->password = Hash::make('jhon@david');
        $user->is_admin = 1;
        $result=$user->save();
        if($result){
            return ["Result" => 'Inserted Successfull'];    
        }
        else{
            return ["Result" => 'Operation Failed'];
        }
        
    }
}
