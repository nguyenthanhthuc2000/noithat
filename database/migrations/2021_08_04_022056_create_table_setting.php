<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_setting', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('email')->nullable();
            $table->text('direct')->nullable();
            $table->string('open_time')->nullable();
            $table->string('hotline_1',13)->nullable();
            $table->string('hotline_2',13)->nullable();
            $table->string('zalo',13)->nullable();
            $table->string('website',65)->nullable();
            $table->string('slogan')->nullable();
            $table->text('iframe_google_map')->nullable();
            $table->text('link_fanpage')->nullable();
            $table->text('link_google_map')->nullable();
            $table->text('seo_title')->nullable();
            $table->text('seo_keywords')->nullable();
            $table->text('seo_description')->nullable();
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
        Schema::dropIfExists('tbl_setting');
    }
}
