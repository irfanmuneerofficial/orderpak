<?php

namespace App\Http\Controllers\Api\V1\Orders;

use App\Http\Controllers\Api\V1\Orders\Interfaces\OrderInterface;
use App\Http\Controllers\Controller;
use App\Models\OrderBook;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderRepository;
    public function __construct(OrderInterface $orderRepository){
        $this->orderRepository=$orderRepository;
    } 

    public function allOrders(Request $request){
        $response=$this->orderRepository->allOrders($request);
        $message_success="Order list of Vendor";
        return $this->successResponse($response,$message_success,200);
    }

    public function findOrder($id){
        $response=$this->orderRepository->findOrder($id);
        if($response==null){
            $message_failure="No such Order found";
            return $this->errorResponse($message_failure,422);
        }
        $message_success = 'Order have been retrieved successfully';
        return $this->successResponse($response,$message_success,200);
    }

    public function genereateInvoice($id){
        $response=$this->orderRepository->findOrder($id);
        if($response==null){
            $message_failure="No such Order found";
            return $this->errorResponse($message_failure,422);
        }
        $response=$this->orderRepository->genereateInvoice($id);
        $message_success = 'Invoice generated';
        return $this->successResponse($response,$message_success,200);
    }

    public function changestatus($id){
        $response=$this->orderRepository->changestatus($id);
        if($response==422){
            $message_failure="No such Order found";
            return $this->errorResponse($message_failure,422);
        }
        else if($response==400){
            $message_failure="Order is already completed or canceled";
            return $this->errorResponse($message_failure,422);
        }
        else{
            $message_success = 'Order status changed to In process';
            return $this->successResponse(null,$message_success,200);
        }


    }
}
