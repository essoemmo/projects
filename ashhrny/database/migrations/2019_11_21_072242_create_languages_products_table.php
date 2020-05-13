<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLanguagesProductsTable extends Migration {

	public function up()
	{
		Schema::create('languages_products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('language_id')->unsigned();
			$table->integer('product_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('languages_products');
	}
}