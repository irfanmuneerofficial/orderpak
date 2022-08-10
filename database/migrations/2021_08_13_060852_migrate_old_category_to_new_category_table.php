<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use App\Models\Categories;

class MigrateOldCategoryToNewCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = [];
        $categories = Category::all();
        foreach($categories as $oldRecord){


            $newData =
                array(
                    'id' => $oldRecord->id,
                    'title'=> $oldRecord->title,
                    'slug'=> $oldRecord->slug,
                    'category_img'=> $oldRecord->category_img,
                    'category_icon'=> $oldRecord->category_icon,
                    'meta_title'=> $oldRecord->meta_title,
                    'meta_description'=> $oldRecord->meta_description,
                    'showtext'=> $oldRecord->show,
                    'hidtext'=> $oldRecord->hide,
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
