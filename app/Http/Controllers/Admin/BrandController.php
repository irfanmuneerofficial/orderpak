<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Brand;
use File;
class BrandController extends Controller
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
        $brands = Brand::get();
        return view('admin.brand.index')->with(compact('brands'));
    }

    public function indexx()
    {
        $brands = Brand::get();
        // return view('admin.brand.index')->with(compact('brands'));
        // $slug = str_slug($request->title);
        return response()->json(['data' => $brands]);
    }

    public function brand_slug(Request $request)
    {
        $data = Brand::where('title',$request->title)->first();
        if(!empty($data)){
            return response()->json(['error' => 'Brand Is Already Taken']);
        }
        else{
            $slug = str_slug($request->title);
            return response()->json(['slug' => $slug]);
        }
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
        if($request->hasFile('brand_img')) 
        {
            $files = $request->file('brand_img');
            $destinationPath = 'uploads/brand/'; // upload path        
            $fileName = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $fileName);
        }
        Brand::Create([
            'title' => $request->title,
            'slug' => $request->slug,
            'brand_img' => $fileName,
            'link' => $request->link,
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );
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
        //
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
        $products = Brand::find($id);

        $path = "uploads/brand/" . $products->brand_img;
        $productImageName=null;
        if(request()->hasFile('brand_img')){
            $productImage = $request->file('brand_img');
            $productImageName = rand() . '.' . $productImage->getClientOriginalExtension();
            $productImage->move('uploads/brand/', $productImageName);
        }

        $products->title = $request->title;
        $products->slug = $request->slug;
        $products->brand_img = ($productImageName) ? $productImageName : $products->brand_img ;
        $products->link = $request->link;

        $products->save();

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
        $attachments = Brand::find($id);
        // $path = public_path().'/uploads/slider/'. $attachments->category_img;
        // unlink($path);
        $attachments->delete();
    }
}