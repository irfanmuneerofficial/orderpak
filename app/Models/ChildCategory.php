<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
	protected $table='child_category';
	protected $guarded=['id'];
    use HasFactory;

    function categoryname()
    {
    	return $this->belongsTo(ParentCategory::class,'parent_id','id');
    }

}
