<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShippingPolicyController extends Controller
{
    public function index()
    {
    	return view('shipping_policy');
    }
}
