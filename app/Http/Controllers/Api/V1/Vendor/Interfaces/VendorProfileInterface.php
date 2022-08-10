<?php

namespace App\Http\Controllers\Api\V1\Vendor\Interfaces;

use Illuminate\Http\Request;

interface VendorProfileInterface
{

    public function findVendor();

    public function editVendor(Request $request);

    public function findVendorShop();

    public function editVendorShop(Request $request);  

    public function updateVendorShop(Request $request);

    public function changePass(Request $request);

    public function validatechangePass(Request $request);
}