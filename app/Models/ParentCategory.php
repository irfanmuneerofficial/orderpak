<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentCategory extends Model
{
	protected $table='parent_category';
	protected $guarded=['id'];
    use HasFactory;


    function categoryname()
    {
    	return $this->belongsTo(Category::class,'main_id','id');
    }
}
