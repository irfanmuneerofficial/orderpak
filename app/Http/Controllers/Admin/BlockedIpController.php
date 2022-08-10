<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlockedIp;

class BlockedIpController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $blocked_ips = BlockedIp::latest()->paginate(5);
        // echo '<pre>';
        // print_r($blocked_ips);die;
        return view('admin.blocked_ips.index')->with(compact('blocked_ips'));

    }
}
