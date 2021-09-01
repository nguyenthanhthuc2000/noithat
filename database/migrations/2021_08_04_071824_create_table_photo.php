<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePhoto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_photo', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('id_photo')->nullable();
            $table->string('tenvi')->nullable();
            $table->string('link')->nullable();
            $table->string('link_video')->nullable();
            $table->string('photo')->nullable();
            $table->string('type')->nullable();
            $table->text('motavi')->nullable();
            $table->text('noidungvi')->nullable();
            $table->tinyInteger('hienthi')->default(0);
            $table->tinyInteger('noibat')->default(0);
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
        Schema::dropIfExists('tbl_photo');
    }
}
