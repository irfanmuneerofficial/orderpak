<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigratedDataShippingCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $shipping_prices = \App\Models\Shipping::all();

        foreach($shipping_prices as $data){
            $pcat =  \App\Models\ParentCategory::select('title', 'slug')->where('id', $data->parent_id)->first();
            $ccat =  \App\Models\ChildCategory::select('title', 'slug')->where('id', $data->child_id)->first();
            

            $pslug = $pcat->slug ?? '';
            $ptitle = $pcat->title ?? '';
            $cslug = $ccat->slug ?? '';
            $ctitle = $ccat->title ?? '';
            $npcat = \App\Models\Categories::select('id', 'title', 'slug')->where('slug', $pslug)->orWhere('title', $ptitle)->first();
            $nccat = \App\Models\Categories::select('id', 'title', 'slug')->where('slug', $cslug)->orWhere('title', $ctitle)->first();
            $npcat_id = $npcat->id ?? '';
            $npcat_title = $npcat->title ?? '';
            $nccat_id = $nccat->id ?? '';
            $nccat_title = $nccat->title ?? '';

            
            \App\Models\Shipping::where('id', '=', $data['id'])
            ->update(['parent_id' => $npcat_id, 'child_id' => $nccat_id]);
      
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
