<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingSmsApiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('setting_sms_api', function (Blueprint $table) {
            $table->id();
            $table->string('api_url')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('phone_number')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('setting_sms_api');
    }
}
