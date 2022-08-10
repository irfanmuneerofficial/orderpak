<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ChildCategory;
use App\Models\Categories;

class MigrateOldChildCategoryToNewCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = [];
        $categories = ChildCategory::all();
        foreach($categories as $oldRecord){


            $newData =
                array(
                    'title'=> $oldRecord->title,
                    'slug'=> $oldRecord->slug,
                    'category_img'=> $oldRecord->image,
                    'parent_id'=> $oldRecord->parent_id,
                    'meta_title'=> $oldRecord->meta_title,
                    'meta_description'=> $oldRecord->meta_description,
                    'showtext'=> $oldRecord->showtext,
                    'hidtext'=> $oldRecord->hidetext,
                    'status'=> 1,
                    'created_at'=> $oldRecord->created_at,
                    'updated_at'=> $oldRecord->updated_at

                );
                array_push($data, $newData);
            // $oldRecord->delete();
        }

        Categories::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('new_categories', function (Blueprint $table) {
        //     //
        // });
    }
}
