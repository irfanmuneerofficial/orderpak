<?php

namespace App\Http\Controllers\Api\V1\Wallet;

use App\Http\Controllers\Api\V1\Wallet\Interfaces\WalletInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    private $walletRepository;
    public function __construct(WalletInterface $walletRepository){
        $this->walletRepository=$walletRepository;
    } 

    public function WalletList(Request $request){
        $response=$this->walletRepository->WalletList($request);
        $message_success="Wallet list retrieved";
        return $this->successResponse($response,$message_success,200);
    }
}
