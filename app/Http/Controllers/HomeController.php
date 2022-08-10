<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use App\Models\HomeBannerOne;
use App\Models\HomeBannerTwo;
use App\Models\HomeBannerThree;
use App\Models\HomeBannerFour;
use App\Models\ParentCategory;
use App\Models\ChildCategory;
use App\Models\Brand;
use App\Models\Sliders;
use App\Models\Subscribe;
use App\Models\Vendor;
use App\Models\Content;
use App\Models\Categories;


class HomeController extends Controller
{

    public function index()
    {
        // $vendors = Vendor::get();
        // foreach($vendors as $vendor){
        //     $slug = str_slug($vendor->business_name,'-');
        //     $vendor->update(['slug'=> $slug]);
        // }
        $categories = Categories::where('parent_id', 0)->get();
        (request()->get('error') !='') ? User::verify(request()->all()) : '';
        $vendors = Vendor::where('status','ACTIVE')->get();
        $product_sec1 = Product::inRandomOrder()->where('admin_status','APPROVED')->where('vendor_status','ACTIVE')->paginate(12);
        $products = Product::where('admin_status','APPROVED')->where('vendor_status','ACTIVE')->get();
        $banner1 = HomeBannerOne::first();
        $product_banner1 = Product::inRandomOrder()->where('admin_status','APPROVED')->where('vendor_status','ACTIVE')->where('category_id', $banner1->category_id)->paginate(12);

        $banner2 = HomeBannerTwo::first();
        $product_banner2 = Product::inRandomOrder()->where('admin_status','APPROVED')->where('vendor_status','ACTIVE')->where('category_id', $banner2->category_id)->paginate(12);

        $banner3 = HomeBannerThree::first();
        $product_banner3 = Product::inRandomOrder()->where('admin_status','APPROVED')->where('vendor_status','ACTIVE')->where('category_id', ($banner3)? $banner3->category_id : '0')->paginate(12);

        $brands = Brand::get();
        $sliders = Sliders::get();
        // print_r($banners);die;
        $pcategories = ParentCategory::get();
        $ccategories = ChildCategory::get();
        $content = Content::select('id', 'title', 'description','meta_title','meta_description')->where('id',1)->first();

        return view('welcome')
        ->with(compact('categories','pcategories','ccategories', 'product_sec1', 'products','banner1', 'banner2', 'banner3','brands','sliders', 'product_banner1', 'product_banner2', 'product_banner3', 'vendors','content' ));
    }

    public function subscribe(Request $request)
    {
        $data = Subscribe::where('email',$request['email'])->first();

        if(!$data)
        {
            $subscribe = new Subscribe;
            $subscribe->email = $request['email'];
            $subscribe->save();
            return back()->with(['success'=>'Subscribtion Successfull','autofocus'=>true]);
        }
        else
        {
            return back()->with(['error'=> 'Already Subscribe','autofocus'=> true]);
        }

    }


}
