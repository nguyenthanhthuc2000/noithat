<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_product', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('tenvi');
            $table->string('slug');
            $table->double('price')->nullable()->default(0);
            $table->double('price_pro')->nullable()->default(0);
            $table->integer('soluong')->nullable()->default(0);
            $table->integer('daban')->nullable()->default(0);
            $table->text('seo_title')->nullable();
            $table->text('seo_keywords')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('motavi')->nullable();
            $table->text('noidungvi')->nullable();
            $table->text('options')->nullable();
            $table->string('chatlieu')->nullable();
            $table->string('noisanxuat')->nullable();
            $table->string('mausac')->nullable();
            $table->string('kichthuoc')->nullable();
            $table->string('bosung')->nullable();
            $table->string('photo')->nullable();
            $table->string('type')->nullable();
            $table->Integer('id_cat')->nullable();
            $table->Integer('id_item')->nullable();
            $table->Integer('id_brand')->nullable();
            $table->Integer('id_tag')->nullable();
            $table->Integer('luotxem')->default(0);
            $table->tinyInteger('moi')->default(0);
            $table->tinyInteger('banchay')->default(0);
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
        Schema::dropIfExists('tbl_product');
    }
}
