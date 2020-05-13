<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_product_id');
            $table->unsignedInteger('item_id');
            $table->enum('product_type_code', ['product', 'service', 'food', 'digital_product', 'cards', 'donation', 'multi_products']);
            $table->timestamps();

            $table->foreign('order_product_id')->references('id')->on('order_products')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product_items');
    }
}
