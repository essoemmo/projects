<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTagTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('tag_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('tag_id')->unsigned()->nullable();
			$table->string('title', 191)->nullable();
			$table->string('locale', 191);
		});
	}

	public function down()
	{
		Schema::drop('tag_translations');
	}
}
