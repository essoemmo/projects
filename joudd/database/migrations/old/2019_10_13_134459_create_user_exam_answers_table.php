<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserExamAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_exam_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('exam_id')->nullable();
            $table->foreign('user_exam_id')->references('id')->on('user_exams')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedInteger('question_id')->nullable();
            $table->foreign('question_id')->references('id')->on('exam_questions')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedInteger('answer_id')->nullable();
            $table->foreign('answer_id')->references('id')->on('question_choices')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->string('score');
            $table->timestamp('created');
            $table->boolean('is_answer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_exam_answers');
    }
}
