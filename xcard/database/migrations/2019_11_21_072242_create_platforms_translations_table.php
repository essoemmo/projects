<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlatformsTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('platforms_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('platform_id')->unsigned()->nullable();
			$table->string('title', 191)->nullable();
			$table->string('locale', 191);
		});
	}

	public function down()
	{
		Schema::drop('platforms_translations');
	}
}
