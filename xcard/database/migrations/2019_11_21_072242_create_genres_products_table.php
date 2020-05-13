<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGenresProductsTable extends Migration {

	public function up()
	{
		Schema::create('genres_products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('genre_id')->unsigned();
			$table->integer('product_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('genres_products');
	}
}