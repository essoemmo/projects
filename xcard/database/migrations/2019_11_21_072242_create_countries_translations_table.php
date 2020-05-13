<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCountriesTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('countries_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('country_id')->unsigned()->nullable();
			$table->string('title', 191)->nullable();
			$table->string('locale');
		});
	}

	public function down()
	{
		Schema::drop('countries_translations');
	}
}
