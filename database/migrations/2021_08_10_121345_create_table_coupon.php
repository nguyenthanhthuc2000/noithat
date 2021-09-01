<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCoupon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_coupon', function (Blueprint $table) {
            $table->Increments('id');
            $table->String('tenvi',100);
            $table->String('code',30);
            $table->Integer('amount');
            $table->Integer('number');
            $table->tinyInteger('status')->default(0);
            $table->String('type',15);
            $table->date('date_end');
            $table->date('date_start');
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
        Schema::dropIfExists('tbl_coupon');
    }
}
