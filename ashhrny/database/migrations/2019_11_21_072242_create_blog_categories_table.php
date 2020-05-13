<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlogCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('blog_categories', function(Blueprint $table) {
			$table->increments('id');
			$table->boolean('main')->default(0);
			$table->string('image')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('blog_categories');
	}
}