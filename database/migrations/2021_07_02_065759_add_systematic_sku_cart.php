<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSystematicSkuCart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('add_cart', function (Blueprint $table) {

            // 1. Create new column
            // You probably want to make the new column
            $table->string('systematic_sku')->after('product_sku');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('add_cart', function (Blueprint $table) {

            // Drop the column
            $table->dropColumn('systematic_sku');
        });
    }
}
