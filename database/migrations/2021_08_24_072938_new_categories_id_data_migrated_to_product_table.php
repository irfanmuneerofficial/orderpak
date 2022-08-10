<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Product;
use App\Models\Categories;
use App\Models\ChildCategory;
use App\Models\ParentCategory;

class NewCategoriesIdDataMigratedToProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $products = Product::all();
        $data = [];
        $categories = Categories::all();
        $childCat = ChildCategory::all();
        foreach($products as $product){
            $data = ParentCategory::select('slug','title','id')->where('id', $product->parent_id)->first();
            $pslug = $data->slug ?? '';
            $ptitle = $data->title ?? '';
            $pcat = Categories::select('id')->where('slug', $pslug)->orWhere('title', $ptitle)->first();

            $data2 = ChildCategory::select('slug','title','id')->where('id', $product->child_id)->first();
            $cslug = $data2->slug ?? '';
            $ctitle = $data2->title ?? '';
            $ccat = Categories::select('id')->where('slug', $cslug)->orWhere('title', $ctitle)->first();
            $pid = $pcat->id ?? '';
            $cid = $ccat->id ?? '';
            Product::where('id', '=', $product->id)
            ->update(['parent_id' => $pid, 'child_id' => $cid]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      
    }
}
