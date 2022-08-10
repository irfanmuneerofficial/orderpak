<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ParentCategory;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\CategoryBanner;
use App\Models\Categories;

class CategoryController extends Controller
{
    public function index()
    {
    	$categories = Categories::where('parent_id', 0)->get();
    	$pcategories = ParentCategory::get();
    	$categorie_banner = CategoryBanner::get();
    	
    	return view('category')
    	->with(compact('categories', 'pcategories','categorie_banner'));
    }
    
    public function main_category($id)
    {
		
        $mcategoriesid = Categories::where('slug',$id)->first();
    	$main_categories = Product::where('category_id', ($mcategoriesid) ? $mcategoriesid->id : '0')->where('admin_status','APPROVED')->where('vendor_status','ACTIVE')->paginate(12);

    	$categories = Categories::where('parent_id', 0)->get();
    	$pcategories = ParentCategory::get();
    	$categorie_banner = CategoryBanner::get();
		
    	return view('main_category')
    	->with(compact('main_categories', 'categories', 'pcategories','categorie_banner','mcategoriesid'));
    }
    
    public function parent_category($mid1,$pid)
    {
        $pcategoriesid = Categories::where('slug',$pid)->first();
    	$parent_categories = Product::where('parent_id', ($pcategoriesid) ? $pcategoriesid->id : '0')->where('admin_status','APPROVED')->where('vendor_status','ACTIVE')->paginate(12);

    	$categories = Categories::where('parent_id', 0)->get();
    	$pcategories = ParentCategory::get();
    	$categorie_banner = CategoryBanner::get();

    	return view('parent_category')
    	->with(compact('parent_categories', 'categories', 'pcategories','categorie_banner','pcategoriesid'));
    }

    public function child_category($mid,$pid,$cid)
    {
        $ccategoriesid = Categories::where('slug',$cid)->first();
    	$child_categories = Product::where('child_id', ($ccategoriesid) ? $ccategoriesid->id :'0' )->where('admin_status','APPROVED')->where('vendor_status','ACTIVE')->paginate(12);

    	$categories = Categories::where('parent_id', 0)->get();
    	$pcategories = ParentCategory::get();
    	$categorie_banner = CategoryBanner::get();

    	return view('child_category')
    	->with(compact('child_categories', 'categories', 'pcategories','categorie_banner','ccategoriesid'));
    }
}
