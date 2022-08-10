<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Sliders;
use File;

class SliderController extends Controller
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
     
    public function index(Request $request)
    {
        $sliders = Sliders::get();
        return view('admin.sliders.index')
        ->with(compact('sliders'));
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
        if($request->hasFile('slider_img')) 
        {
            $files = $request->file('slider_img');
            $destinationPath = 'uploads/slider/'; // upload path
            // Upload Orginal Image           
            $fileName = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $fileName);
        }    
        Sliders::Create([
            'name' => $request->name,
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
            'slider_img' => $fileName,
            'address' => $request->address
        ]);

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
    public function edit($id)
    {
        $comapny  = Sliders::find($id);

        return response()->json([
          'data' => $comapny
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function update(Request $request ,$id)
    {
        $userData = Sliders::find($id);
        $currentImage = $userData->slider_img;
        $productImageName=null;
        if(request()->hasFile('slider_img')){
            $productImage = $request->file('slider_img');
            $productImageName = rand() . '.' . $productImage->getClientOriginalExtension();
            $productImage->move('uploads/slider/', $productImageName);
        }

        $userData->name = request('name');
        $userData->title = request('title');
        $userData->description = request('description');
        $userData->link = request('link');
        $userData->slider_img = ($productImageName) ? $productImageName : $currentImage;
        
        $userData->save();
       
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
        $attachments = Sliders::find($id);
        // $path = '/uploads/slider/'. $attachments->slider_img;
        // unlink($path);
        $attachments->delete();
        return redirect()->back();
    }
}