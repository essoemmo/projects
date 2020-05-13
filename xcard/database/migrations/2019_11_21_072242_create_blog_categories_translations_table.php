<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlogCategoriesTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('blog_categories_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('blog_category_id')->unsigned()->nullable();
			$table->string('title', 191)->nullable();
			$table->string('locale', 191)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('blog_categories_translations');
	}
}