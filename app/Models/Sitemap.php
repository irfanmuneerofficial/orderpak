<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sitemap extends Model
{
	protected $table='sitemaps';
	protected $guarded=['id'];
    // use HasFactory;

	public function getSitemapNameAttribute()
    {
        $sitemap_name = '';

		if ($this->type == 'category' && $this->level == '1') {
			$sitemap_name = 'main_category';
        }

		if ($this->type == 'category' && $this->level == '2') {
			$sitemap_name = 'parent_category';
        }

		if ($this->type == 'category' && $this->level == '3') {
			$sitemap_name = 'child_category';
        }

		if ($this->type == 'product') {
			$sitemap_name = 'product';
        }

		if ($this->type == 'static') {
			$sitemap_name = 'static';
        }

		if ($this->type == 'shop' && $this->level == 'vendor') {
			$sitemap_name = 'shop_vendor';
        }

        return $sitemap_name;
    }
}
