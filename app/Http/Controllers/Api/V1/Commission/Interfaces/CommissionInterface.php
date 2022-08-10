<?php

namespace App\Http\Controllers\Api\V1\Commission\Interfaces;

use Illuminate\Http\Request;

interface CommissionInterface
{
    public function commissionList(Request $request);
}