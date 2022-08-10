<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shopinfo;
use Auth;
use File;
class ShopInfoController extends Controller
{
    
    public function __construct()
    {
        // $this->middleware('guest');
        // $this->middleware('guest:admin');
        // $this->middleware('guest:vendor');
        $this->middleware('auth:vendor');
        // $this->middleware('auth');
    }

    public function index()
    {
        $data =Shopinfo::where('vendor_id',Auth::guard('vendor')->user()->id)->first();
        return view('vendor_panel.shop.index')
        ->with(compact('data'));
    }

    public function check_slug(Request $request)
    {
        $data = Shopinfo::where('shop_name',$request->shop_name)->first();
        if(!empty($data)){
            return response()->json(['error' => 'Shop Name Is Already Taken']);
        }
        else{
            $slug = str_slug($request->shop_name);
            return response()->json(['slug' => $slug]);
        }
    }

    public function create()
    {
        return view('vendor_panel.shop.create');
    }

    public function store(Request $request)
    {
       if (request()->hasFile('shop_img')) 
        {
            $file = request()->file('shop_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/vendor/shop/', $fileName);
        }

        Shopinfo::create([
            'vendor_id' => Auth::guard('vendor')->user()->id,
            'shop_name' => $request['shop_name'],
            'slug' => $request['slug'],
            'shop_img' => $fileName,
        ]);
        return redirect('/vendor/shop');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data =Shopinfo::where('vendor_id',Auth::guard('vendor')->user()->id)->first();
        return view('vendor_panel.shop.edit')
        ->with(compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Shopinfo::find($id);

        $currentImage = $user->shop_img;
        $fileName = null;

        if (request()->hasFile('shop_img')) 
        {
            $file = request()->file('shop_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/vendor/shop/', $fileName);
        }
        $user->update([
            'shop_name' => $request['shop_name'],
            'slug' => $request['slug'],
            'shop_img' => ($fileName) ? $fileName : $currentImage,
        ]);

        if($fileName)
            File::delete('./uploads/vendor/shop/' . $currentImage);

        return redirect('/vendor/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
