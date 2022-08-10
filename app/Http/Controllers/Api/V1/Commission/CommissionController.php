<?php

namespace App\Http\Controllers\Api\V1\Commission;

use App\Http\Controllers\Api\V1\Commission\Interfaces\CommissionInterface;
use App\Http\Controllers\Controller;
use App\Models\Commission;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    private $commissionRepository;
    public function __construct(CommissionInterface $commissionRepository){
        $this->commissionRepository=$commissionRepository;
    } 

    public function commissionList(Request $request){
        $commisssion=$this->commissionRepository->commissionList($request);
        $message_success="Commission list retrieved";
        return $this->successResponse($commisssion,$message_success,200);
    }
}
