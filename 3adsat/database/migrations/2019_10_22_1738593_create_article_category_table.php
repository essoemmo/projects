<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleCategoryTable extends Migration {

	public function up()
	{
		Schema::create('article_category', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('category_id')->unsigned();
			$table->integer('article_id')->unsigned();
			$table->timestamps();

			$table->foreign('category_id')->references('id')->on('artcl_categories')
				->onDelete('cascade')
				->onUpdate('cascade');

			$table->foreign('article_id')->references('id')->on('articles')
				->onDelete('cascade')
				->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::drop('article_category');
	}
}