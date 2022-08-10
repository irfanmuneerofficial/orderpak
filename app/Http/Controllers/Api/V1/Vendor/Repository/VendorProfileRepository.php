<?php

namespace App\Http\Controllers\Api\V1\Vendor\Repository;

use App\Http\Controllers\Api\V1\Vendor\Interfaces\VendorProfileInterface;
use App\Models\Shopinfo;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class VendorProfileRepository implements VendorProfileInterface{

    public function findVendor(){
        $usr=auth('apivendor')->user();
        return Vendor::select('first_name','last_name','business_name','business_email','business_address','cnic')
        ->where('id',$usr->id)->first();
    }

    public function editVendor(Request $request){
        $usr=auth('apivendor')->user();
        Vendor::where('id',$usr->id)->update($request->all());
    }

    public function findVendorShop(){
        $usr=auth('apivendor')->user();
        $response=Shopinfo::where('vendor_id',$usr->id)->first();
        $response['image_path']='/uploads/vendor/shop/';
        return $response;
    }

    public function editVendorShop(Request $request){
        if($request->hasFile('shopimage'))
        {
            $file = $request->file('shopimage');
            $nmwithex = $file->getClientOriginalName();
            $filename = pathinfo($nmwithex, PATHINFO_FILENAME);
            $ext = $file->getClientOriginalExtension();
            $fl_store = $filename . time() . '.' . $ext;
            $file->move('./uploads/vendor/shop/', $fl_store);
            //$path = $file->storeAs('images', $fl_store);
            $request->request->add(['shop_img' =>$fl_store]);
        }
        $request=$request->except(['shopimage']);
        $usr=auth('apivendor')->user();
        Shopinfo::where('vendor_id',$usr->id)->update($request);
    }

    public function updateVendorShop(Request $request){
        if ($request->hasFile('shopimage')) {
            $file = $request->file('shopimage');
            $nmwithex = $file->getClientOriginalName();
            $filename = pathinfo($nmwithex, PATHINFO_FILENAME);
            $ext = $file->getClientOriginalExtension();
            $fl_store = $filename . time() . '.' . $ext;
            $path = $file->storeAs('images', $fl_store);
            $request->request->remove('shopimage');
            $request->request->add(['shop_image' =>$fl_store]);
        }
        //Shopinfo::where('id',$id)->update($request->all());
    }

    public function validatechangePass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Oldpassword' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required'
        ]);

        $error = array();

        if ($validator->fails()) {
            $error['status']  = 'fail';
            $error['status_code']  = 401;
            $error['error'] = $validator->errors();
            return response()->json(['response' => $error])->setStatusCode(401);
        }
        else
        {
            return null;
        }
    }

    public function changePass(Request $request){
        $usr=auth('apivendor')->user();
        $vendor=Vendor::where('id',$usr->id)->first();
        if (Auth::guard('vendor')->attempt(['business_email' =>$vendor->business_email, 'password' => $request->Oldpassword])) {
            if($request->password==$request->password_confirmation){
                $pass=Hash::make($request->password);
                Vendor::where('id',$usr->id)->update(['password'=>$pass]);
            }
            else{
                return 401;
            }
        }
        else{
            return 401;
        }
    }
}