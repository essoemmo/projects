<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_options', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('order_accept')->default(1);
            $table->tinyInteger('product_rating')->default(1);
            $table->tinyInteger('product_outStock')->default(1);
            $table->tinyInteger('discount_codes')->default(1);
            $table->tinyInteger('product_purchases_count')->default(1);
            $table->tinyInteger('similar_products')->default(1);
            $table->unsignedInteger('store_id')->nullable();

            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('store_options');
    }
}
