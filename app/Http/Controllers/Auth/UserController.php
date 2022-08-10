<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Twilio\Jwt\ClientToken;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Rules\MatchUserOldPassword;
use Auth;

class UserController extends Controller
{
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
    	//print_r($request['password']);die;
        
        $user = tap(User::create([
        	'fullname'=> $request['fullname'],
        	'email'=> $request['email'],
        	'password'=> Hash::make($request['password']),
        	'phone'=> $request['phone_no'],
        	'isVerified'=> true,
        ]));
        Mail::to($request['email'])->send(new \App\Mail\UserRegister('Thanks for registration! :)'));
        // return redirect()->to('/login')->with(['message' => 'Phone number verified']);
        return redirect('/user-register-thankyou');
    }
    
    public function verify_phone(Request $request){
        $token = 'e06e8f90164448f1ae698f1f6a3ca164';
        $twilio_sid = 'AC1f1ccb1686e28c2b24b6439c13c7ee22';
        $twilio_verify_sid = 'VA70083c33aac15bce41b4bb72336330a7';
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create(request()->get('verify'), array('to' => '+92'.request()->get('phone')));
        if ($verification->valid) {
            return response()->json(['data'=>'Phone number verified']);
        }
        else{
            return response()->json(['data'=>'non-valid']);
        }
    }

    public function userlogout(Request $request)
    {

        Auth::logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect( '/login' );
    }
    
    public function email(Request $request)
    {
        $data = User::where('email',$request->email)->first();
        if(!empty($data)){
            return response()->json(['error' => 'Email Is Already Registered']);
        }
        else{
            return response()->json(['email' => $request->email]);
        }
    }

    public function check_phone(Request $request)
    {
        $checkPhone = User::where('phone', $request->phone)->pluck('phone')->first();
        // print_r($request->phone);die;
        if(!empty($checkPhone)){
            return response()->json(['error' => 'Phone Is Already Registered!']);
        }
        else{
            return response()->json(['success' => $request->phone]);
        }
    }
    
    public function store(Request $request)
    {
        // dd(request()->all());
        $request->validate([
            'old_password' => ['required', new MatchUserOldPassword],
            'password' => ['required'],
            'confirm_password' => ['same:password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->password)]);

        return redirect()->back()->with('success','Password change successfully.');
    }
}
