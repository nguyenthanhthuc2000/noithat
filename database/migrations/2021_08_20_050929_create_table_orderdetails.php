<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOrderdetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_order_details', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('order_code',10);
            $table->Integer('product_id');
            // $table->string('product_name')->nullable(); 
            // $table->string('product_image')->nullable();
            // $table->double('product_price',11)->nullable();
            // $table->double('product_price_pro',65)->nullable();
            $table->Integer('product_qty')->nullable();
            $table->string('shipping_cou',15);
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('tbl_order_details');
    }
}
