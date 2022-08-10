<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ParentCategory;
use App\Models\ChildCategory;
use App\Models\Categories;

class UpdateCategoriesParent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = [];
        $categories = Categories::all();
        
        foreach($categories as $mcat){
            $data = ParentCategory::select('slug','title','id')->where('slug', $mcat->slug)->first();
            if(isset($data->slug) || isset($data->title)){
                $parentData = Categories::select('slug','title','id','parent_id')->where('slug', $data->slug)->orWhere('title', $data->title)->first();
                  ChildCategory::where('parent_id', $data->id)->where('migrated', '=', 0)
                            ->update(['parent_id' => $parentData->id, 'migrated' => 1]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
