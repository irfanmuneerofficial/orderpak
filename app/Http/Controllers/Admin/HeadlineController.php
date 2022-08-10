<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Headline;
use File;

class HeadlineController extends Controller
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
    
    public function index()
    {
        $headline = Headline::first();
        return view('admin.headline.index')
        ->with(compact('headline'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fileName = null;
        if($request->hasFile('logo')) 
        {
            $files = $request->file('logo');
            $destinationPath = 'uploads/admin/headline/'; // upload path        
            $fileName = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $fileName);
        }

        $headline = new Headline;
        $headline->description = $request['description'];
        $headline->logo = $fileName;
        $headline->bgcolor = $request['bgcolor'];
        $headline->save();
        return redirect()->back();
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
    public function remove()
    {
        $product = Headline::get()->first();
        $path = 'uploads/admin/headline/'.$product->logo;
        if(!empty($product->logo)){
        unlink($path); 
        $product->logo = '';
        $product->save();
        }

        return response()->json(['success' => 'Remove Success']);
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
        $headline = Headline::find($id);

        $path = "uploads/admin/headline/" . $headline->logo;
        $productImageName=null;
        if(request()->hasFile('logo')){
            $productImage = $request->file('logo');
            $productImageName = rand() . '.' . $productImage->getClientOriginalExtension();
            $productImage->move('uploads/admin/headline/', $productImageName);
        }

        $headline->description = $request['description'];
        $headline->logo = ($productImageName) ? $productImageName : $headline->logo ;
        $headline->bgcolor = $request['bgcolor'];
        $headline->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $headline = Headline::find($id);
        
        File::delete('/uploads/admin/headline/'.$headline->logo);

        $headline->delete();
        return redirect()->back();
    }
}