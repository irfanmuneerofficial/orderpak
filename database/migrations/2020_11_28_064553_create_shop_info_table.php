<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_info', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_id',11)->nullable();
            $table->string('shop_name',100)->nullable();
            $table->string('slug',100)->nullable();
            $table->string('shop_img',100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_info');
    }
}
