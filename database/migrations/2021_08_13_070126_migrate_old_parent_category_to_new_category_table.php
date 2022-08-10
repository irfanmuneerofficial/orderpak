<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ParentCategory;
use App\Models\Categories;

class MigrateOldParentCategoryToNewCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = [];
        $categories = ParentCategory::all();
        foreach($categories as $oldRecord){

            $text = $oldRecord->hidetext ?? '';
            $newData =
                array(
                    'title'=> $oldRecord->title,
                    'slug'=> $oldRecord->slug,
                    'category_img'=> $oldRecord->image,
                    'parent_id'=> $oldRecord->main_id,
                    'meta_title'=> $oldRecord->meta_title,
                    'meta_description'=> $oldRecord->meta_description,
                    'showtext'=> $oldRecord->showtext,
                    'hidtext'=> $text,
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
        // Schema::table('new_category', function (Blueprint $table) {
        //     //
        // });
    }
}
