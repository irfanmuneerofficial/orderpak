<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Auth;
use Symfony\Component\HttpFoundation\Session\Session;
    

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:vendor')->except('logout');
    }
    
    public function showAdminLoginForm()
    {
        return view('auth.login_vendor');
    }

    public function vendorLogin(Request $request)
    {
        $session = new Session();
        $approvalStatus = Vendor::where('business_email', $request->business_email)->first();
        // print_r($approvalStatus);die;
        if(empty($approvalStatus)){
            return redirect()->back()->with(['invalid' => 'Please do correct Your Personal Email']);
        }
        if($approvalStatus->status == 'ACTIVE')
        {
            if (Auth::guard('vendor')->attempt(['business_email' => $request->business_email, 'password' => $request->password])) 
            {
                $session->remove('guest_chk');
                return redirect()->intended('/vendor/dashboard');
            }   
        }
        else
        {
            return redirect()->back()->with(['invalid' => 'Your account is deactivated from admin!']);
        }
        // return back()->withInput($request->only('business_email'));
        // $data = Vendor::where('business_email',$request['business_email'])->first();
        
        

        if(!Auth::guard('vendor')->attempt(['business_email' => $request->business_email, 'password' => $request->password])){
                return redirect()->back()->with(['invalid' => 'Please do correct Your Password']);    
        }
    }

    
}
