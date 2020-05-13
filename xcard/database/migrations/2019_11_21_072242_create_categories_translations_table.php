<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('categories_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('category_id')->unsigned()->nullable();
			$table->string('title', 191)->nullable();
			$table->text('description')->nullable();
			$table->string('locale', 191);
		});
	}

	public function down()
	{
		Schema::drop('categories_translations');
	}
}
