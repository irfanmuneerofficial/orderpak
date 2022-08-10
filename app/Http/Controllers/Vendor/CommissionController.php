<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commission;

class CommissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:vendor');
    }
    
    public function index()
    {
    	$commissions = Commission::get();
    	return view('vendor_panel.commission.index')
    	->with(compact('commissions'));
    }
}
