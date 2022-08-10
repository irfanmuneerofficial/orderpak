<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ParentCategory;

class SearchController extends Controller
{

    public function search(Request $request)
    {
        $key = trim($request->get('q'));

        $products = Product::query()->where('title', 'like', "%{$key}%")->orWhere('model', 'like', "%{$key}%")->orWhere('price', 'like', "%{$key}%")->orWhere('sale_price', 'like', "%{$key}%")->orWhere('warrenty_type', 'like', "%{$key}%")->orWhere('product_sku', 'like', "%{$key}%")->orWhere('search_sku', 'like', "%{$key}%")->orWhere('systematic_sku', 'like', "%{$key}%")->get();

        $categories = Category::get();
        $pcategories = ParentCategory::get();

        return view('search')
        ->with(compact('products', 'categories', 'pcategories'));
    }
}
