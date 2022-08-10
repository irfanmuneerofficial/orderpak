<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_info', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('user_id')->nullable();
            $table->string('is_success')->nullable();
            $table->string('message')->nullable();
            $table->string('consignment_number')->nullable();
            $table->string('courier_type');
            $table->string('label')->nullable();
            $table->smallInteger('status')->nullable();
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
        Schema::dropIfExists('shipment_info');
    }
}
