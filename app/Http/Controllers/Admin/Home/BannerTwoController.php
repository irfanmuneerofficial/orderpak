<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\HomeBannerTwo;
use File;

class BannerTwoController extends Controller
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
        $categories = Category::get();
        $bannertwos = HomeBannerTwo::get();
        return view('admin.home.bannertwo.index')
        ->with(compact('categories','bannertwos'));
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
        $fileName=null;
        if (request()->hasFile('banner_img')) {
            $file = request()->file('banner_img');
            $fileName = date('Yddii') .'.'. $file->getClientOriginalExtension();
            $file->move('./uploads/home/banner/',$fileName);
        }

        HomeBannerTwo::create([
            'category_id' => $request->category_id,
            'banner_img' => $fileName,
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
        $data = HomeBannerTwo::find($id);
        $fileName='';
        if (request()->hasFile('banner_img')) {
            File::delete('./uploads/home/banner/',$data->banner_img);
            $file = request()->file('banner_img');
            $fileName = date('Yddii') .'.'. $file->getClientOriginalExtension();
            $file->move('./uploads/home/banner/',$fileName);
        }

        $data->update([
            'category_id' => $request->category_id,
            'banner_img' => ($fileName) ? $fileName : $data->banner_img,
        ]);

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
        $data = HomeBannerTwo::find($id);
        $data->delete();

    }
}
