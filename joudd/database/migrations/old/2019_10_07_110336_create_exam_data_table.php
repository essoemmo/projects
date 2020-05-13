<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('exam_data');
        Schema::create('exam_data', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->unsignedInteger('exam_id')->nullable();
            $table->text('description');
            $table->unsignedInteger('lang_id')->nullable();

            $table->foreign('exam_id')->references('id')->on('exams')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('lang_id')->references('id')->on('languages')
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
        Schema::dropIfExists('exam_data');
    }
}
