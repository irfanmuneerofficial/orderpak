<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShopBanner;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function banner(request $request)
    {
        // Post Banner
        if ($request->isMethod('post')) {
            $banner = $request['banner_img'];
            $link = $request['link'];

            $fileName = null;
            if($request->hasFile('banner_img')) 
            {
                $files = $request->file('banner_img');
                $destinationPath = 'uploads/shop/'; // upload path
                // Upload Orginal Image           
                $fileName = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $fileName);
            }    
            ShopBanner::Create([
                'link' => $request->link,
                'banner_img' => $fileName,
            ]);
            return redirect()->back();
        }

        // Update Bnner
        elseif ($request->isMethod('put')) {

            $userData = ShopBanner::find($request['id']);
            $currentImage = $userData->banner_img;
            $productImageName=null;
            if(request()->hasFile('banner_img')){
                $productImage = $request->file('banner_img');
                $productImageName = rand() . '.' . $productImage->getClientOriginalExtension();
                $productImage->move('uploads/shop/', $productImageName);
            }

            $userData->link = request('link');
            $userData->banner_img = ($productImageName) ? $productImageName : $currentImage;
            
            $userData->save();
            return redirect()->back();
        }

        elseif ($request->isMethod('delete')) 
        {
            // print_r($id);die;
            $attachments = ShopBanner::find($request['id']);
            $path = public_path().'/uploads/shop/'. $attachments->banner_img;
            unlink($path);
            $attachments->delete();
            return redirect()->back();

        }

        // get Banner
        else
        {
            $shops = ShopBanner::get();
            return view('admin.shop.banner')->with(compact('shops'));
        }
    }
}
