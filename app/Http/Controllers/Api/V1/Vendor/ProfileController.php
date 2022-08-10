<?php

namespace App\Http\Controllers\Api\V1\Vendor;

use App\Http\Controllers\Api\V1\Vendor\Interfaces\VendorProfileInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    private $profileRepository;
    public function __construct(VendorProfileInterface $profileRepository){
        $this->profileRepository=$profileRepository;
    } 

    public function findVendor(){
        $vendor=$this->profileRepository->findVendor();
        if(empty($vendor)){
            $message_failure="No Vendor found against this id";
            return $this->errorResponse($message_failure,422);
        }

        $message_success = 'VendorProfile have been retrieved successfully';
        return $this->successResponse($vendor,$message_success,200);
    }

    public function editVendor(Request $request){
        $vendor=$this->profileRepository->findVendor();
        if(empty($vendor)){
            $message_failure="No Vendor found against this id";
            return $this->errorResponse($message_failure,422);
        }
        $this->profileRepository->editVendor($request);
        $message_success = 'Vendor Profile has been updated';
        return $this->successResponse(null,$message_success,200);
    }

    public function editVendorShop(Request $request){
        $shop=$this->profileRepository->findVendorShop();
        if(empty($shop)){
            $message_failure="No Vendor found against this id";
            return $this->errorResponse($message_failure,422);
        }
        $response=$this->profileRepository->editVendorShop($request);
        $message_success = 'Vendor Shop has been updated';
        return $this->successResponse($response,$message_success,200);
    }

    public function updateVendorShop(Request $request){
        $this->profileRepository->updateVendorShop($request);
        $message_success = 'Vendor Shop has been updated';
        return $this->successResponse(null,$message_success,200);
        
    }

    public function findVendorShop(){
        $shop=$this->profileRepository->findVendorShop();
        if(empty($shop)){
            $message_failure="No Shop found for this vendor";
            return $this->errorResponse($message_failure,422);
        }
        $message_success = 'Vendor Shop have been retrieved successfully';
        return $this->successResponse($shop,$message_success,200);
        
    }

    public function changePass(Request $request){
        $response=$this->profileRepository->validatechangePass($request);
        if($response!=null){
            return $response;
        }

        $response=$this->profileRepository->changePass($request);
        $message_failure='Your email or password is not correct';
        if($response==401){
            return $this->errorResponse($message_failure,401);
        }
        
        $message_success = 'Password has been changed successfully';
        return $this->successResponse(null,$message_success,200);

    }
}
