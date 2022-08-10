<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorPayoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_payout', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_id');
            $table->string('account_title',100);
            $table->string('account_no',100);
            $table->string('bank_name',100);
            $table->string('branch_code',100);
            
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
        Schema::dropIfExists('vendor_payout');
    }
}
