<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Categories extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $fillable = [
    //     'title', 'meta_title', 'meta_keyword', 'meta_description', 'description', 'slug', 'parent_id'
    // ];

    public function parentCategory()
    {
        return $this->belongsTo(Categories::class, 'parent_id');

    }

    public function childCategories()
    {
        return $this->hasMany(Categories::class, 'parent_id');

    }

    protected static function boot() {
        parent::boot(); //need to call parent's boot method
        static::deleting( function ($category) {
            $category->childCategories->each(function($cat){ //edit after comment
                $cat->delete();
            });
        });
    }

    public function createSlug($title, $id = 0)
    {
        $slug = Str::slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);
    }

    // Recursive parents
    public function parents() {
        return $this->belongsTo(Categories::class, 'parent_id')
          			->with('parentCategory');
    }

    // Recursive children
    public function children() {
        return $this->hasMany(Categories::class, 'parent_id')
          			->with('childCategories');
    }


    // protected function getRelatedSlugs($slug, $id = 0)
    // {
    //     return CategoryDescription::select('slug')->where('slug', 'like', $slug.'%')
    //     ->where('category_id', '<>', $id)
    //     ->get();
    // }

    public static function fileExit($path, $fileName)
    {
        if(\File::isDirectory($path)){
            $path = public_path($path.'/'.$fileName);
            
            if(\File::exists($path)){
                return true;
            } else {
                return false;
            }
        }
    }

    public function commission() {
        return $this->hasOne(Commission::class, 'category_id', 'id');
    }
}
