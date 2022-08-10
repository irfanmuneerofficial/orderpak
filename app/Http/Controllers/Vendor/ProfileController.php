<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Follower;
use App\Models\Vendor;
use App\Models\Shopinfo;
use Auth;

class ProfileController extends Controller
{
	
	public function __construct()
    {
        $this->middleware('auth:vendor');
    }

    public function index()
    {
    	$id=Auth::guard('vendor')->user()->id;
    	
    	$data =Shopinfo::where('vendor_id',$id)->first();

    	$follower = Follower::where('vendor_id',$id)->pluck('follower')->count();
    	return view('vendor_panel.profile.index')
    	->with(compact('follower','id', 'data'));
    }

    public function edit()
    {
    	$id=Auth::guard('vendor')->user()->id;
    	$data =Vendor::find($id);
    	
    	return view('vendor_panel.profile.edit')
    	->with(compact('id', 'data'));
    }
    
    public function update(Request $request)
    {
        // dd($request->all());
    	$id=Auth::guard('vendor')->user()->id;
    	$data =Vendor::find($id);
    	
    	$data->update([
    	    'first_name' => $request['first_name'],
    	    'last_name' => $request['last_name'],
    	   // 'personal_email' => $request['personal_email'],
    	    'cnic' => $request['cnic'],
    	    'business_address' => $request['business_address'],
    	    ]);

    	return redirect()->to('vendor/profile');
    }
}
