<?php

namespace App\Http\Controllers\Admin;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commission;
use App\Models\Category;
use App\Models\ParentCategory;
use App\Models\ChildCategory;
use File;
use App\Models\Categories;

class CommissionController extends Controller
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
        $commissions = Commission::all();
        $commissions_count = Commission::count();
        return view('admin.commission.index')->with(compact('commissions', 'commissions_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::where('parent_id', 0)->get();
        $parentcategory = ParentCategory::get();
        $childcategory = ChildCategory::get();

        return view('admin.commission.create')
        ->with(compact('categories', 'parentcategory', 'childcategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Commission::Create([
            'main_rate' => $request->main_rate,
            'category_id' => $request->category_id,
            'parent_rate' => $request->parent_rate,
            'parent_id' => $request->parent_id,
            'child_rate' => $request->child_rate,
            'child_id' => $request->child_id,
        ]);

        return redirect()->to('admin/commission')->with('success', 'Commission added successfully!');
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
        $commission = Commission::find($id);
        $categories = Categories::where('parent_id', 0)->get();
        $parentcategory = ParentCategory::get();
        $childcategory = ChildCategory::get();

        return view('admin/commission/edit')
        ->with(compact('commission','categories','parentcategory','childcategory'));
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
        $commission = Commission::find($id);

        $commission->update([
            'main_rate' => $request->main_rate,
            'category_id' => $request->category_id,
            'parent_rate' => $request->parent_rate,
            'parent_id' => $request->parent_id,
            'child_rate' => $request->child_rate,
            'child_id' => $request->child_id,
        ]);

        return redirect()->to('admin/commission')->with('success', 'Commission edit successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Commission::find($id);
        $product->delete();
         return back()->with('success', 'Your Commission has been deleted!');
    }
    
    public function search_by_length($lengthParam)
    {
        // dd($length);
        $length = $lengthParam;
        $commissions_count = Commission::count();

        if($lengthParam == 'all')
        {
            $commissions = Commission::get();
        }
        else
        {
            $commissions = Commission::paginate($lengthParam);
        }

        return view('admin.commission.index')->with(compact('commissions', 'length','commissions_count'));
    }
}
