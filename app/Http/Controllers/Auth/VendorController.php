<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Twilio\Jwt\ClientToken;
use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\Mail\SendMailablee;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use Notification;
use App\Notifications\VendorRegisterNotification;
use Auth;

class VendorController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:vendor')->except('logout');
    // }

    public function index()
    {
        return view('auth.register');
    }
	protected function verification(Request $request)
    {
        /* Get credentials from .env */
        $token = 'e06e8f90164448f1ae698f1f6a3ca164';
        $twilio_sid = 'AC1f1ccb1686e28c2b24b6439c13c7ee22';
        $twilio_verify_sid = 'VA70083c33aac15bce41b4bb72336330a7';
        $twilio = new Client($twilio_sid, $token);
        $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create($request['phone_no'], "sms");
        return response()->json(['success'=>$request['phone_no']]);
    }

    protected function register(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'alternate_phone_no' => 'required|regex:/^[0-9]*$/|size:10',
            'business_name' => 'required|unique:vendors',
            'business_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'cnic' => 'required|regex:/^[0-9]{5}-[0-9]{7}-[0-9]$/|unique:vendors',
            'business_email' => 'required|email|unique:vendors',
            'phone_no' => 'required|unique:vendors|regex:/^[0-9]*$/|size:10',
            'password' => 'required|string|min:6|same:confirm_password',
            'confirm_password' => 'required',
        ]);
        
        $state_name = DB::table("provinces")->select('name')->where("id", $request->state)->get();
        $city_name = DB::table("cities")->select('name')->where("city_slug", $request->city)->get();
		
        $user = tap(Vendor::create([
            'first_name'=> $request['first_name'],
            'last_name'=> $request['last_name'],
            'phone_no'=> $request['phone_no'],
            'alternate_phone_no'=> $request['alternate_phone_no'],
            'password'=> Hash::make($request['password']),
            'business_name'=> $request['business_name'],
            'slug' => str_slug($request['business_name'],'-'),
            'business_email'=> $request['business_email'],
            'business_address'=> $request['business_address'],
            'city'=> $request['city'],
            'state'=> $request['state'],            
            'cnic'=> $request['cnic'],
            'status'=> 'DEACTIVE',
            'ip' => $request->ip(),
            'agent' => $request->server('HTTP_USER_AGENT'),
            'isVerified'=> true,
        ])); 

        Mail::to($request['business_email'])->send(new \App\Mail\VendorRegister('Thanks for registration! :)'));
        //02April2022
        $adminuser = Admin::where('id',1)->get();
        $vendorusr = DB::table('vendors')->where('business_email', $request['business_email'])->first();
        $vendoruser = json_decode(json_encode($vendorusr), true);
        var_dump($vendoruser);
        Notification::send($adminuser, new VendorRegisterNotification($vendoruser));
        dd($vendoruser);
        // return redirect()->to('/vendor/login')->with(['message' => 'You are register successfully! Please wait for admin approval.']);
        return redirect('/vendor-register-thankyou');
    }
    
    public function verify_phone(Request $request){
        $token = 'e06e8f90164448f1ae698f1f6a3ca164';
        $twilio_sid = 'AC1f1ccb1686e28c2b24b6439c13c7ee22';
        $twilio_verify_sid = 'VA70083c33aac15bce41b4bb72336330a7';
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create(request()->get('verify'), array('to' => '+'.request()->get('phone')));
        if ($verification->valid) {
            return response()->json(['data'=>'valid']);
        }
        else{
            return response()->json(['data'=>'non-valid']);
        }
    }

    public function vendorlogout(Request $request)
    {

        Auth::guard('vendor')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect( '/vendor/login' );
    }
    
    public function check_businessmail(Request $request)
    {
        $data = Vendor::where('business_email',$request->business_email)->first();
        if(!empty($data)){
            return response()->json(['error' => 'Email Is Already Registered']);
        }
        else{
            return response()->json(['business_mail' => $request->business_email]);
        }
    }
    
    public function check_businessname(Request $request)
    {
        $data = Vendor::where('slug',str_slug($request['business_name'],'-'))->first();
        if(!empty($data)){
            return response()->json(['error' => 'Business Name Is Already Registered']);
        }
        else{
            return response()->json(['business_name' => $request->business_name]);
        }
    }

    public function check_phone(Request $request)
    {
        $checkPhone = Vendor::where('phone_no', $request->phone)->first();
        if(!empty($checkPhone)){
            return response()->json(['error' => 'Phone Is Already Registered!']);
        }
        else{
            return response()->json(['success' => $request->phone]);
        }
    }

    public function check_businesscnic(Request $request)
    {
        $checkCnic = Vendor::where('cnic', $request->cnic)->first();
        if(!empty($checkCnic)){
            return response()->json(['error' => 'CNIC Is Already Registered!']);
        }
        else{
            return response()->json(['success' => $request->cnic]);
        }
    }       
}