<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlidersTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('sliders_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('slider_id')->unsigned()->nullable();
			$table->string('title', 191)->nullable();
			$table->text('description')->nullable();
			$table->string('locale', 191);
		});
	}

	public function down()
	{
		Schema::drop('sliders_translations');
	}
}
