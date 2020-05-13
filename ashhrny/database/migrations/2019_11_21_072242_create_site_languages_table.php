<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSiteLanguagesTable extends Migration {

	public function up()
	{
		Schema::create('site_languages', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title', 191)->nullable();
			$table->string('flag', 191)->nullable();
			$table->string('locale', 191)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('site_languages');
	}
}