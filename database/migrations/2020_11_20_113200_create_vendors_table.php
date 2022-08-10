<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('first_name',200)->nullable();
            $table->string('last_name',200)->nullable();
            $table->string('password',200)->nullable();
            $table->string('address',200)->nullable();
            $table->string('city',200)->nullable();
            $table->string('business_email')->unique();
            $table->string('personal_email')->unique();
            $table->string('phone_no')->unique();
            $table->string('zipcode',200)->nullable();
            $table->string('state',200)->nullable();
            $table->string('status',10)->nullable();
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
        Schema::dropIfExists('vendors');
    }
}
