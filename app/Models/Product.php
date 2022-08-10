<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use \Conner\Tagging\Taggable;

    protected $table = 'product';
    protected $guarded = ['id'];

    public function setImagesAttribute($value)
    {
        $this->attributes['images'] = json_encode($value);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class,'vendor_id','id');
    }

    public function shop()
    {
        return $this->belongsTo(Shopinfo::class,'vendor_id','vendor_id');
    }

    public function brand()
    {
    	return $this->belongsTo(Brand::class,'brand_id','id');
    }

    // public function categoryname()
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

    public function categoryname()
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

    public function cCategory(){
        return $this->belongsTo(Categories::class, 'child_id', 'id');
    }

    public function pCategory(){
        return $this->belongsTo(Categories::class, 'parent_id', 'id');
    }

    public function category(){
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }

    public function productAttribute()
    {
        return $this->hasMany(ProductAttribute::class,'product_id');
    }

    protected $casts = [
        'variation' => 'array'
    ];

    public function setMetaAttribute($value)
    {
        $list = [];

        foreach ($value as $array_item) {
            if (!is_null($array_item['key'])) {
                $list[] = $array_item;
            }
        }

        $this->attributes['variation'] = json_encode($list);
    }
}
