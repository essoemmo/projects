<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderStatusDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_status_datas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('order_statuses')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('title');
            $table->integer('lang_id');
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
        Schema::dropIfExists('order_status_datas');
    }
}
