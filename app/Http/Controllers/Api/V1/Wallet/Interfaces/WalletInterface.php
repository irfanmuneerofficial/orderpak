<?php

namespace App\Http\Controllers\Api\V1\Wallet\Interfaces;

use Illuminate\Http\Request;

interface WalletInterface
{
    public function WalletList(Request $request);
}