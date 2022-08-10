<?php

namespace App\Http\Controllers\Api\V1\BankInfo\Repository;

use App\Http\Controllers\Api\V1\BankInfo\Interfaces\BankInfoInterface;
use App\Models\VendorPayout;
use Illuminate\Http\Request;
use Validator;
use Log;
use App\Models\Vendor;
class BankInfoRepository implements BankInfoInterface{

    const EXPIRATION_TIME = 15; // minutes

    public function BankInfoList(Request $request){
        $usr=auth('apivendor')->user();

        return VendorPayout::select('id','account_title', 'account_no','bank_name','branch_code')
        ->where('vendor_id',$usr->id)->first();

    }

    public function validatecreateInfo(Request $request){
        $validator = Validator::make($request->all(), [
            'account_title'=>'required|regex:/^[\pL\s\-]+$/u',
            'account_no'=>'required|numeric',
            'bank_name'=>'required|regex:/^[\pL\s\-]+$/u',
            'branch_code'=>'required|numeric',
        ]);

        $error = null;

        if ($validator->fails()) {
            return $error=$validator->messages();
        }
        else
        {
            return null;
        }
    }

    public function createInfo(Request $request){
        $usr=auth('apivendor')->user();
        $request->request->add(['vendor_id'=>$usr->id]);
        VendorPayout::create($request->all());
    }

    public function deleteInfo($id){
        VendorPayout::where('id',$id)->delete();
    }

    public function editInfo(Request $request,$id){
        VendorPayout::where('id',$id)->update($request->all());
    }

    public function findInfo($id){
        $usr=auth('apivendor')->user();
        return VendorPayout::where('id',$id)->where('vendor_id',$usr->id)->first();
    }

    public function requestOtp()
    {
        $otp = rand(1000,9999);
        Log::info("otp = ".$otp);

        $vendor = Vendor::where('id', auth('apivendor')->user()->id)->update(['otp_code' => $otp, 'expire_otp_time' => \Carbon\Carbon::now('PKT')]);

        if($vendor){

            $mail_details = [
                'subject' => 'Testing Application OTP',
                'body' => 'Your OTP is : '. $otp
            ];

            //  \Mail::to($request->email)->send(new sendEmail($mail_details));

            return ['otp_code' => $otp];
        }
    }

    public function validateVendorPhone(Request $request){
        $validator = Validator::make($request->all(), [
            'phone_no' => 'required|regex:/^(\+92)[\d]{10}$/|max:13'
        ]);

        $error = null;

        if ($validator->fails()) {
            return $error=$validator->messages();
        }
        else
        {
            return null;
        }
    }

    public function verifyOtp(Request $request){

        $vendor = Vendor::where([['id', '=', auth('apivendor')->user()->id], ['otp_code', '=', $request->otp_code]])->first();

        if($vendor && !$this->isExpired($vendor->expire_otp_time)){
            Vendor::where('id', '=', auth('apivendor')->user()->id)->update(['otp_code' => null, 'expire_otp_time' => null]);
            return ["verified_status" => 1];
        }
        else{
            return ["verified_status" => 0];
        }
    }

    /**
     * Is the current token expired
     *
     * @return bool
     */
    public function isExpired($exp_time)
    {
        return $dateDiff = \Carbon\Carbon::now('PKT')->diffInMinutes($exp_time,false) > static::EXPIRATION_TIME;
    }

}
