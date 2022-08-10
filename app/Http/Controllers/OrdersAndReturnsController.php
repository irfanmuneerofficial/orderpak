<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdersAndReturnsController extends Controller
{
    public function index()
    {
    	return view('orders_and_returns');
    }
}
