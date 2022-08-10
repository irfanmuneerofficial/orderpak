<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Http\Controllers\Api\V1\Dashboard\Interfaces\DashboardInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $dashboardRepository;
    public function __construct(DashboardInterface $dashboardRepository){
        $this->dashboardRepository=$dashboardRepository;
    } 

    public function dashboardNumbers(){
        $response=$this->dashboardRepository->dashboardNumbers();
        $message_success="Dashboard list retrieved";
        return $this->successResponse($response,$message_success,200);
    }
}
