<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
use Hash;

class AccountSettingController extends Controller
{
    public function profileShow(){
        $profile = Auth::guard('admin')->user();
        return view('admin.account_settings.profile', compact('profile'));
    }

    public function profileEdit(){
        $profile = Auth::guard('admin')->user();
        return view('admin.account_settings.profile_edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profileUpdate(Request $request)
    {
        $profile = Auth::guard('admin')->user();
        $this->validate($request, [
            'first_name' => 'required',
            'email' => 'required|email|unique:admins,email,'.$profile->id,
        ]);

        $input = $request->all();

        if ($profile_image = $request->file('avatar')) {
            $request->validate([
                'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time().'.'.$request->avatar->extension();

            $request->avatar->move(public_path('admin/images/profile'), $imageName);

            $input['profile_image'] = $imageName;
        }

        $profile->update($input);

        return redirect()->route('admin.profile.show')
                        ->with('success','Admin user updated successfully');
    }

    public function profileChangePassword(){
        $profile = Auth::guard('admin')->user();
        return view('admin.account_settings.profile_change_pass', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profileUpdatePassword(Request $request)
    {
        $profile = Auth::guard('admin')->user();

        $request->validate([
            'new_password' => 'required|min:6',
            'password_confirmation' => 'required|same:new_password',
        ]);

        Admin::find($profile->id)->update(['password'=> Hash::make($request->new_password)]);

        return redirect()->route('admin.profile.show')
                        ->with('success','Admin user password updated successfully');
    }

}
