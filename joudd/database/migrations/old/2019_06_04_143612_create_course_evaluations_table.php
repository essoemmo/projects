<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCourseEvaluationsTable extends Migration {

	public function up()
	{
		Schema::create('course_evaluations', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('applicant_id')->unsigned();
			$table->integer('course_id')->unsigned();
			$table->integer('question_id')->unsigned();
			$table->text('answer');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('course_evaluations');
	}
}