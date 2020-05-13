<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlogsProductsTable extends Migration {

	public function up()
	{
		Schema::create('blogs_products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('blog_id')->unsigned()->nullable();
			$table->integer('product_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('blogs_products');
	}
}