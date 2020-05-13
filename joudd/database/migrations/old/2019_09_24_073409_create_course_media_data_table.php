<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseMediaDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_media_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('media_id')->unsigned()->nullable();
            $table->string('title');
            $table->integer('lang_id')->unsigned()->nullable();
            $table->integer('source_id')->unsigned()->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('media_id')->references('id')->on('course_media')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('lang_id')->references('id')->on('languages')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('source_id')->references('id')->on('course_media_data')
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
        Schema::dropIfExists('course_media_data');
    }
}
