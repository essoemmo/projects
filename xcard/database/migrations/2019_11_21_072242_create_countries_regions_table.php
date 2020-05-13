<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCountriesRegionsTable extends Migration {

	public function up()
	{
		Schema::create('countries_regions', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('country_id')->unsigned();
			$table->integer('region_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('countries_regions');
	}
}