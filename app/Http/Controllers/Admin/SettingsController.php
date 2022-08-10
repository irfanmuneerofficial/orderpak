<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::where('id','=','1')->first();
        return view('admin.settings.setting',compact('settings'));
    }
    
    public function process(Request $request)
    {
        $postData = $request->all();
        $getSettings = Setting::where('id','=','1')->get();
        if(count($getSettings) > 0){
            $updateScriptText = Setting::where('id','=', '1')->update(['script_text' => $postData['script_text']]);
            return back()->with(['success'=>'Script Text Successfully Updated','autofocus'=>true]);
        }else{
            $createScriptText = Setting::create(['script_text' => $postData['script_text']]);
            return back()->with(['success'=>'Script Text Successfully Added','autofocus'=>true]);
        }
    }
}