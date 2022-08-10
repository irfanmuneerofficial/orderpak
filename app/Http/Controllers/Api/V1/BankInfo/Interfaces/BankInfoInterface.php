<?php

namespace App\Http\Controllers\Api\V1\BankInfo\Interfaces;

use Illuminate\Http\Request;

interface BankInfoInterface
{
    public function BankInfoList(Request $request);

    public function validatecreateInfo(Request $request);

    public function createInfo(Request $request);

    public function deleteInfo($id);

    public function editInfo(Request $request,$id);

    public function findInfo($id);

    public function requestOtp();

    public function verifyOtp(Request $request);
}
