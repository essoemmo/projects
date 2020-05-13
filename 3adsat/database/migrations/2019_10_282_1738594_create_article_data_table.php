<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleDataTable extends Migration {

	public function up()
	{
		Schema::create('article_data', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('source_id')->unsigned()->nullable();
			$table->integer('lang_id')->unsigned()->nullable();
			$table->string('title', 150);
			$table->text('content')->nullable();
			$table->date('created')->nullable();
			$table->timestamps();

			$table->foreign('source_id')->references('id')->on('articles')
				->onDelete('cascade')
				->onUpdate('cascade');
			$table->foreign('lang_id')->references('id')->on('languages')
				->onDelete('cascade')
				->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::drop('article_data');
	}
}