<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymenttransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paymenttransfer', function (Blueprint $table) {
            $table->id();
            $table->string('order_id',100)->nullable();
            $table->string('vendor_id',100)->nullable();
            $table->string('prodcut_id',100)->nullable();
            $table->string('amount',100)->nullable();
            $table->string('file',200)->nullable();
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
        Schema::dropIfExists('paymenttransfer');
    }
}
