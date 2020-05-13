<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGenreTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('genre_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title', 191)->nullable();
			$table->string('locale', 191);
			$table->integer('genre_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('genre_translations');
	}
}
