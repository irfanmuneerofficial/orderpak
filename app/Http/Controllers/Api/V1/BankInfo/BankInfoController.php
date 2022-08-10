<?php

namespace App\Http\Controllers\Api\V1\BankInfo;

use App\Http\Controllers\Api\V1\BankInfo\Interfaces\BankInfoInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BankInfoController extends Controller
{
    private $bankInfoRepository;
    public function __construct(BankInfoInterface $bankInfoRepository){
        $this->bankInfoRepository=$bankInfoRepository;
    }

    public function BankInfoList(Request $request){
        $response=$this->bankInfoRepository->BankInfoList($request);
        $message_success="BankInfo list retrieved";
        return $this->successResponse($response,$message_success,200);
    }

    public function createInfo(Request $request){
        $response=$this->bankInfoRepository->validatecreateInfo($request);
        if($response!=null)
        {
            return $this->errorResponse($response,422);
        }

        $this->bankInfoRepository->createInfo($request);
        $message_success = 'Bank Info has been added';
        return $this->successResponse(null,$message_success,200);
    }

    public function deleteInfo($id){
        $response=$this->bankInfoRepository->findInfo($id);
        if(empty($response)){
            $message_failure="No such Bank Info";
            return $this->errorResponse($message_failure,422);
        }
        $this->bankInfoRepository->deleteInfo($id);
        $message_success = 'BankInfo has been deleted';
        return $this->successResponse(null,$message_success,200);
    }

    public function editInfo(Request $request,$id){
        $response=$this->bankInfoRepository->findInfo($id);
        if(empty($response)){
            $message_failure="No Info found";
            return $this->errorResponse($message_failure,422);
        }
        $this->bankInfoRepository->editInfo($request,$id);
        $message_success = 'BankInfo has been updated';
        return $this->successResponse(null,$message_success,200);
    }

    public function requestOtp(){
        $response = $this->bankInfoRepository->requestOtp();
        $message_success = 'Otp request has been sent';
        return $this->successResponse($response,$message_success,200);
    }

    public function verifyOtp(Request $request){

        $response = $this->bankInfoRepository->verifyOtp($request);
        if($response['verified_status'] == 1){
            $message_success = 'Otp verfied successfully';
        }
        else{
            $message_success = 'Invalid or expired';
        }
        return $this->successResponse($response, $message_success, 200);
    }

}
