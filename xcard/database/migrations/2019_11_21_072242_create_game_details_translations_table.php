<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGameDetailsTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('game_details_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('game_detail_id')->unsigned()->nullable();
			$table->string('title', 191)->nullable();
			$table->string('locale', 191);
		});
	}

	public function down()
	{
		Schema::drop('game_details_translations');
	}
}
