<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_choices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->unsignedInteger('question_id')->nullable();
            $table->unsignedInteger('lang_id')->nullable();
            $table->boolean('is_answer');

            $table->timestamps();

            $table->foreign('question_id')->references('id')->on('exam_questions')
                ->onDelete('cascade')
                ->onUpdate('cascade');


            $table->foreign('lang_id')->references('id')->on('languages')
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
        Schema::dropIfExists('question_choices');
    }
}
