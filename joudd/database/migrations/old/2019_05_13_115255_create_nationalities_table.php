<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNationalitiesTable extends Migration {

	public function up()
	{
		Schema::dropIfExists('nationalities');
		Schema::create('nationalities', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('country_code', 10);
			$table->string('country_name', 100);
		});
	}

	public function down()
	{
		Schema::drop('nationalities');
	}
}