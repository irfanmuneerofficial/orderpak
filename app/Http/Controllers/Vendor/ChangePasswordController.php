<?php

namespace App\Http\Controllers\Vendor;
use App\Models\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function ChangePassword(Request $request)
    {

    	$hashedPassword = Auth::guard('vendor')->user()->password;

        $validatedData = $request->validate([
            'password' => 'required|string|min:6|same:confirm_password',
            'confirm_password' => 'required',
		]);
		
    	if(Hash::check($request->old_password,$hashedPassword))
    	{
			$user = Vendor::find(Auth::guard('vendor')->user()->id);

    		$user->password = Hash::make($request->password);

    		$user->save();

			Auth::guard('vendor')->logout();

    		return redirect()->to('/vendor/login')->with('success', 'Your Password has been changed successfully.');
    	}
    	else
    	{
    		return redirect()->back()->with('invalid', "Your Current Password is invalid.");
    	}

    }
}
