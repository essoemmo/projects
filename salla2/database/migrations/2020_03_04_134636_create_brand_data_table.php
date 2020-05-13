<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id')->unsigned()->nullable();
            $table->integer('lang_id')->unsigned()->nullable();
            $table->integer('source_id')->unsigned()->nullable();
            $table->string('name', 150);
            $table->text('description')->nullable();

            $table->foreign('brand_id')->references('id')->on('brands')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('lang_id')->references('id')->on('languages')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('source_id')->references('id')->on('brands_data')
            ->onDelete('cascade')
            ->onUpdate('cascade');
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
        Schema::dropIfExists('brands_data');
    }
}
