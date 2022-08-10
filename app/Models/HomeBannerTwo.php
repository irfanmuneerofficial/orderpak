<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeBannerTwo extends Model
{
	protected $table='home_banner_two';
	protected $guarded=['id'];
    use HasFactory;


    public function category()
    {
    	return $this->belongsTo(Category::class,'category_id');
    }
}
