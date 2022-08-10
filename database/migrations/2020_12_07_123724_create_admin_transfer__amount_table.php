<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTransferAmountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_transfer_amount', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('transection_id')->nullable();
            $table->string('gateway_transaction_id')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('transection_fee')->nullable();
            $table->string('admin_fee')->nullable();
            $table->string('payment')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('admin_transfer_amount');
    }
}
