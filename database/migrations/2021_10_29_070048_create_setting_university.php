<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSettingUniversity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_university', function (Blueprint $table) {
            $table->id();
            $table->string('pdf_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->timestamps();
        });
        DB::table('setting_university')->insert(
            array(
                'pdf_url' => 'http://www.africau.edu/images/default/sample.pdf',
                'youtube_url' => '<iframe width="727" height="409" src="https://www.youtube.com/embed/wBDSR0x3GZo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_university');
    }
}
