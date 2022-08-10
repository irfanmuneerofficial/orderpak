<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
	protected $table='commission';
	protected $guarded=['id'];
    use HasFactory;


    // public function category()
    // {
    // 	return $this->belongsTo(Category::class,'category_id','id');
    // }

    // public function parentcategory()
    // {
    // 	return $this->belongsTo(ParentCategory::class,'parent_id','id');
    // }

    // public function childcategory()
    // {
    // 	return $this->belongsTo(ChildCategory::class,'child_id','id');
    // }

    public function category()
    {
    	return $this->belongsTo(Categories::class,'category_id','id');
    }

    public function parentcategory()
    {
    	return $this->belongsTo(Categories::class,'parent_id','id');
    }

    public function childcategory()
    {
    	return $this->belongsTo(Categories::class,'child_id','id');
    }
}
