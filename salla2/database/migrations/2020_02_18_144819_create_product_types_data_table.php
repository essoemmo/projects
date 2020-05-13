<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTypesDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_types_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_types_id')->unsigned()->nullable();
            $table->integer('lang_id')->unsigned()->nullable();
            $table->integer('source_id')->unsigned()->nullable();
            $table->string('title', 150);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('product_types_id')->references('id')->on('product_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('lang_id')->references('id')->on('languages')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('source_id')->references('id')->on('product_types_data')
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
        Schema::dropIfExists('product_types_data');
    }
}
