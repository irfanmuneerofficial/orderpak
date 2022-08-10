<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParentCategory;
use App\Models\ChildCategory;
use App\Models\Categories;

class ParentCategoryController extends Controller
{
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
}
