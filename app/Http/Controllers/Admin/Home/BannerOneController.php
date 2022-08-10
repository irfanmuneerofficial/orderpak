<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\HomeBannerOne;
use App\Models\ParentCategory;
use App\Models\ChildCategory;
use File;
use App\Models\Categories;

class BannerOneController extends Controller
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
        $bannerone = HomeBannerOne::first();
        if(!empty($bannerone)){
            $category = Category::where('id',$bannerone->category_id)->first();
        }
        else{
            $category ='';
        }    
        $categories = Category::get();
        return view('admin.home.bannerone.index')
        ->with(compact('category','bannerone','categories'));
    }

    public function getparentcategory()
    {
        $id = request()->get('id');
        $data = Categories::where('parent_id',$id)->get();
        return $data;
    }

    public function getchildcategory()
    {
        $id = request()->get('id');
        $data = Categories::where('parent_id',$id)->get();
        return $data;
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

        HomeBannerOne::create([
            'category_id' => $request->category_id,
            'parent_id' => $request->parent_id,
            'child_id' => $request->child_id,
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
        $data = HomeBannerOne::find($id);
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
        $data = HomeBannerOne::find($id);
        $data->delete();

    }
}
