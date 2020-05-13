<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCountriesTable extends Migration {

	public function up()
	{
		Schema::create('countries', function(Blueprint $table) {
			$table->increments('id');
			$table->string('logo', 191)->nullable();
			$table->string('code', 10)->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('countries');
	}
}