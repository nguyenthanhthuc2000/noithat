<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFeeship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_feeship', function (Blueprint $table) {
            $table->Increments('id');
            $table->Integer('id_matp')->nullable();
            $table->Integer('id_maqh')->nullable();
            $table->Integer('id_xa')->nullable();
            $table->Integer('feeship')->nullable();
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
        Schema::dropIfExists('tbl_feeship');
    }
}
