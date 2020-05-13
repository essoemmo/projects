<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLanguagesTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('languages_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title', 191)->nullable();
			$table->integer('language_id')->unsigned()->nullable();
			$table->string('locale', 191);
		});
	}

	public function down()
	{
		Schema::drop('languages_translations');
	}
}
