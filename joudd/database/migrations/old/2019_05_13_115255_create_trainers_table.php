<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTrainersTable extends Migration {

	public function up()
	{
		Schema::dropIfExists('trainers');
		Schema::create('trainers', function(Blueprint $table) {
			$table->increments('id');
//			$table->string('first_name', 150);
//			$table->string('last_name', 150);
//			$table->string('mobile', 15);
			$table->enum('gender', array('Female', 'Male'));
			$table->string('skills', 250)->nullable();
			$table->date('created')->nullable(true);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('trainers');
	}
}
