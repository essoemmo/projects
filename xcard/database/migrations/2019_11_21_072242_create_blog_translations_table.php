<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlogTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('blog_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('blog_id')->unsigned()->nullable();
			$table->string('title', 191)->nullable();
			$table->text('content')->nullable();
			$table->string('locale', 191);
		});
	}

	public function down()
	{
		Schema::drop('blog_translations');
	}
}
