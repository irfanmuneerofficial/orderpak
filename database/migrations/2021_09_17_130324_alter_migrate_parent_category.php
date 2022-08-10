<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMigrateParentCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = App\Models\ParentCategory::all();
        foreach($categories as $val){
            $pslug = $val->slug ?? '';
            $ptitle = $val->title ?? '';
            // $data = App\Models\Categories::select('hidetext')->where('id', $val->id)->where()->first();
            App\Models\Categories::where('slug', '=', $pslug)->orWhere('title', '=', $ptitle)
            ->update(['hidtext' => $val->hidetext]);
        }

        $ccategories = App\Models\ChildCategory::all();
        foreach($ccategories as $val){
            $pslug = $val->slug ?? '';
            $ptitle = $val->title ?? '';
            // $data = App\Models\Categories::select('hidetext')->where('id', $val->id)->where()->first();
            App\Models\Categories::where('slug', '=', $pslug)->orWhere('title', '=', $ptitle)
            ->update(['hidtext' => $val->hidetext]);
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
