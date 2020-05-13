<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoCategoryCourseTable extends Migration {

	public function up()
	{
		Schema::dropIfExists('co_category_course');
		Schema::create('co_category_course', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('course_id')->unsigned();
			$table->integer('co_category_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('co_category_course');
	}
}