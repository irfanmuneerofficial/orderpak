<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Shipping;
use App\Models\ParentCategory;
use App\Models\ChildCategory;

class ShippingController extends Controller
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
        
        $shipping_prices = Shipping::all();
        return view('admin.shipping.index')->with(compact('shipping_prices'));
    }

    public function getparentcategory()
    {
        $id = request()->get('id');
        $data = ParentCategory::where('main_id',$id)->get();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $subcategories = ParentCategory::get();
        $shipping_prices = Shipping::get();

        return view('admin.shipping.create')->with(compact('categories', 'shipping_prices', 'subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        Shipping::Create([
            'main_id' => $request->main_id,
            'main_price' => $request->main_price,
            'parent_id' => $request->parent_id,
            'parent_price' => $request->parent_price,
            'child_id' => $request->child_id,
            'child_price' => $request->child_price,
        ]);

       return redirect()->to('/admin/shipping');
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
        $shipping = Shipping::find($id);
        $categories = Category::get();
        $subcategories = ParentCategory::get();
        $childcategory = ChildCategory::get();
        $shipping_prices = Shipping::get();

        return view('admin.shipping.edit')->with(compact('shipping', 'categories', 'shipping_prices', 'subcategories', 'childcategory'));
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
        // dd($request->all());
        $shipping = Shipping::find($id);
        $shipping->main_id = $request->main_id;
        $shipping->main_price = $request->main_price;
        $shipping->parent_id = $request->parent_id;
        $shipping->parent_price = $request->parent_price;
        $shipping->child_id = $request->child_id;
        $shipping->child_price = $request->child_price;
        $shipping->save();

        return redirect()->to('/admin/shipping');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shipping = Shipping::find($id);
        $shipping->delete();
        return redirect()->back();
    }
    
    public function search_by_length($lengthParam)
    {
        // dd($lengthParam);
        $length = $lengthParam;
        $shipping_count = Shipping::count();

        if($lengthParam == 'all')
        {
            $shipping_prices = Shipping::get();
        }
        else
        {
            $shipping_prices = Shipping::paginate($lengthParam);
        }

        return view('admin.shipping.index')->with(compact('shipping_prices', 'length','shipping_count'));
    }
}
