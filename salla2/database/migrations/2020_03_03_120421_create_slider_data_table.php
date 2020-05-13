<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSliderDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('slider_id')->unsigned()->nullable();
            $table->integer('lang_id')->unsigned()->nullable();
            $table->integer('source_id')->unsigned()->nullable();
            $table->string('name', 150);
            $table->text('description')->nullable();

            $table->foreign('slider_id')->references('id')->on('sliders')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('lang_id')->references('id')->on('languages')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('source_id')->references('id')->on('sliders_data')
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
        Schema::dropIfExists('sliders_data');
    }
}
