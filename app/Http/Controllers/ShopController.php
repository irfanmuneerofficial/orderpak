<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Shopinfo;
use App\Models\Category;
use App\Models\ParentCategory;
use App\Models\ShopBanner;
use App\Models\AddCart;
use App\Models\OrderBook;
use App\Models\CategoryBanner;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::inRandomOrder()->where('admin_status','APPROVED')->where('vendor_status','ACTIVE')->paginate(21);
        $shops = Shopinfo::get();
        $categories = Category::get();
        $pcategories = ParentCategory::get();
        $banners = ShopBanner::get();
        return view('shop',compact('products','shops','categories','pcategories', 'banners'))->with('i', ($request->input('page', 1) - 1) * 5);
        // ->with();    
    }

    public function detail($id)
    {
        $vendor = Vendor::where('slug',$id)->first();
        $shop = Shopinfo::where('vendor_id',$vendor->id)->first();
        $carts = AddCart::get();
        $booked = OrderBook::where('vendor_id',$vendor->id)->get();
        $categories = Category::get();
        $pcategories = ParentCategory::get();
        $categorie_banner = CategoryBanner::get();
        $products = Product::where('admin_status','APPROVED')->where('vendor_status','ACTIVE')->where('vendor_id',$vendor->id)->get();
        // dd($products);
        $listedcount = Product::where('admin_status','APPROVED')->where('vendor_status','ACTIVE')->where('vendor_id',$vendor->id)->get()->count();

        return view('shop_detail')
        ->with(compact('shop', 'vendor','carts','booked','products','categories','categorie_banner','pcategories','listedcount'));
    }
}