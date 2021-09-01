<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBlog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_blog', function (Blueprint $table) {
            $table->Increments('id');
            $table->Integer('id_tag')->nullable();
            $table->string('tenvi');
            $table->text('motavi')->nullable();
            $table->text('noidungvi')->nullable();
            $table->string('photo')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('tbl_blog');
    }
}
