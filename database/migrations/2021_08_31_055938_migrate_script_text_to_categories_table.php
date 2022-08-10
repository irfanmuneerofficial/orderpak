<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrateScriptTextToCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $categories = \App\Models\Categories::where('parent_id', '=', 0)->get();
        $data = [];
        foreach($categories as $data){
            $cccat =  \App\Models\Category::select('title', 'slug', 'script_text')->where('id' , $data->id)->first();
          
            
            $ccslug = $cccat->slug ?? '';
            $cctitle = $cccat->title ?? '';
            $ccscript_text = $cccat->script_text ?? '';
            
            App\Models\Categories::where('id', '=', $data['id'])->where('slug', $data->slug)->orWhere('title', $data->title)
            ->update(['script_text' => $ccscript_text]);
        }

        $pcategories = \App\Models\Categories::where('parent_id', '>', 0)->get();
        foreach($pcategories as $data){
            $pcat =  \App\Models\ParentCategory::select('title', 'slug', 'script_text')->where('main_id', $data->parent_id)->where('slug', $data->slug)->first();
            
            $pslug = $pcat->slug ?? '';
            $ptitle = $pcat->title ?? '';
            $pscript_text = $pcat->script_text ?? '';
            

            App\Models\Categories::where('id', '=', $data['id'])->where('slug', $data->slug)->orWhere('title', $data->title)
            ->update(['script_text' => $pscript_text]);
            
        }

        $ccategories = \App\Models\Categories::where('parent_id', '>', 0)->get();
        foreach($ccategories as $data){

            $ccat =  \App\Models\ChildCategory::select('title', 'slug', 'script_text')->where('parent_id', $data->parent_id)->first();

            $cslug = $ccat->slug ?? '';
            $ctitle = $ccat->title ?? '';
            $cscript_text = $ccat->script_text ?? '';

            App\Models\Categories::where('id', '=', $data['id'])->where('slug', $data->slug)->orWhere('title', $data->title)
            ->update(['script_text' => $cscript_text]);
            
        }
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            //
        });
    }
}
