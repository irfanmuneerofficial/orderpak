<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderbookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderbook', function (Blueprint $table) {
            $table->id();
            $table->string('cart_id');
            $table->string('user_id');
            $table->string('order_id');
            $table->string('product_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('cash_delivery_no');
            $table->string('city');
            $table->string('zipcode');
            $table->string('address');
            $table->string('state');
            $table->string('amount');
            $table->string('quantity');
            $table->string('size');
            $table->string('color');
            $table->string('message')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('orderbook');
    }
}
