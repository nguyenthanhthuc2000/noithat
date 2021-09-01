<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBrandProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_brand_product', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('tenvi');
            $table->string('slug');
            $table->text('seo_title')->nullable();
            $table->text('seo_keywords')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('motavi')->nullable();
            $table->text('noidungvi')->nullable();
            $table->string('photo')->nullable();
            $table->tinyInteger('hienthi')->default(0);
            $table->tinyInteger('noibat')->default(0);
            $table->tinyInteger('trangthai')->default(0);
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
        Schema::dropIfExists('tbl_brand_product');
    }
}
