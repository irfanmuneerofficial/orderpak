<?php

namespace App\Http\Controllers\User;

use App\Models\Addressbook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $address = Addressbook::where('userid',Auth::user()->id)->get();
        // print_r($address);die;
    	return view('user_panel.profile')
        ->with(compact('address'));
    }
    
    public function changephone()
    {
    	return view('user_panel.changephone');
    }
    
    public function change_phone(request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->fullname = $request->fullname;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->save();
        return redirect()->to('/user/dashboard');
    }

    public function editname(request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->fullname = $request->fullname;
        $data->save();
    }
    
    

    public function ChangePassword(Request $request)
    {

    	$hashedPassword = Auth::user()->password;

        $validatedData = $request->validate([
            'password' => 'required|string|min:6|same:confirm_password',
            'confirm_password' => 'required',
		]);
		
    	if(Hash::check($request->old_password,$hashedPassword))
    	{
			$user = User::find(Auth::user()->id);

    		$user->password = Hash::make($request->password);

    		$user->save();

			Auth::logout();

    		return redirect()->to('/login')->with('success', 'Your Password has been changed successfully.');
    	}
    	else
    	{
    		return redirect()->back()->with('invalid', "Your Current Password is invalid.");
    	}

    }

    public function addressbook(Request $request)
    {
        $data = $request->all();
        $id = Auth::user()->id;
        $user = new Addressbook;
        $user->userid = $id;
        $user->fullname = $request->fullname;
        $user->phone_no = $request->phone_no;
        $user->area = $request->area;
        $user->address = $request->address;
        $user->home = $request->home;
        $user->office = $request->office;
        $user->save();
        return redirect()->back();
    }

    public function addressbookupdate(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $id = Auth::user()->id;
        $user = Addressbook::find($data['id']);
        $user->userid = $id;
        $user->fullname = $request->fullname;
        $user->phone_no = $request->phone_no;
        $user->area = $request->area;
        $user->address = $request->address;
        $user->home = $request->home;
        $user->office = $request->office;
        $user->save();
        return redirect()->back();
    }

    public function delete( Request $request)
    {
        // dd($request->all());
        $user = Addressbook::find($request->id);
        $user->delete();
        return redirect()->back();
    }


    // public function homeaddress(Request $request)
    // {
    //     $data = $request->all();
    //     $user = User::find(Auth::user()->id);
    //     $user->home_address = $request->home_address;
    //     $user->save();
    //     return redirect()->back();
    // }
}
