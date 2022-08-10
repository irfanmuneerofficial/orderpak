<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id');
            $table->string('product_sku');
            $table->string('category_id');
            $table->string('parent_id')->nullable();
            $table->string('child_id')->nullable();
            $table->string('brand_id');
            $table->string('title');
            $table->string('model')->nullable();
            // $table->text('tags');
            $table->longText('short_description');
            $table->longText('product_description');
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->string('image_4')->nullable();
            $table->string('image_5')->nullable();
            $table->string('image_6')->nullable();
            $table->string('color_check')->nullable();
            $table->string('colors')->nullable();
            $table->string('size_chart')->nullable();
            $table->string('size_check')->nullable();
            $table->string('size_name')->nullable();
            $table->string('size_qty')->nullable();
            
            // $table->string('colors');
            $table->string('price');
            $table->string('sale_status')->nullable();
            $table->string('sale_price')->nullable();
            $table->string('sale_details')->nullable();
            // $table->string('sale_start')->nullable();
            // $table->string('sale_start_time')->nullable();
            // $table->string('sale_end')->nullable();
            // $table->string('sale_end_time')->nullable();
            $table->string('quantity');
            $table->string('condition');
            $table->longText('additional_details');
            $table->string('warrenty_type');
            $table->string('warrenty_period')->nullable();
            $table->text('warrenty_policy')->nullable();
            $table->string('vendor_status');
            $table->string('admin_status');
            $table->timestamps();


        	// SAAD MIGRATION

            // $table->id();
            // $table->foreignId('vendor_id');
            // $table->string('product_sku');
            // $table->string('category_id');
            // $table->string('parent_id');
            // $table->string('child_id');
            // $table->string('brand_id');
            // $table->string('title');
            // $table->string('model');
            // $table->string('sizes');
            // $table->text('tags');
            // $table->longText('short_description');
            // $table->longText('product_description');
            // $table->string('image_1')->nullable();
            // $table->string('image_2')->nullable();
            // $table->string('image_3')->nullable();
            // $table->string('image_4')->nullable();
            // $table->string('image_5')->nullable();
            // $table->string('image_6')->nullable();
            // $table->string('colors');
            // $table->string('price');
            // $table->string('sale_status')->nullable();
            // $table->string('sale_price')->nullable();
            // $table->string('sale_details')->nullable();
            // $table->string('quantity');
            // $table->string('condition');
            // $table->longText('additional_details');
            // $table->string('warrenty_type');
            // $table->string('warrenty_period');
            // $table->text('warrenty_policy');
            // $table->string('status');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
