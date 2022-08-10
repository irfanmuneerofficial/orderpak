<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $table = 'shipping';
    protected $guarded = ['id'];


    // function category()
    // {
    // 	return $this->belongsTo(Category::class,'main_id','id');
    // }

    // function subcategory()
    // {
    // 	return $this->belongsTo(ParentCategory::class,'parent_id','id');
    // }

    // function childcategory()
    // {
    //     return $this->belongsTo(ChildCategory::class,'child_id','id');
    // }

    function category()
    {
    	return $this->belongsTo(Categories::class,'main_id','id');
    }

    function subcategory()
    {
    	return $this->belongsTo(Categories::class,'parent_id','id');
    }

    function childcategory()
    {
        return $this->belongsTo(Categories::class,'child_id','id');
    }
}
