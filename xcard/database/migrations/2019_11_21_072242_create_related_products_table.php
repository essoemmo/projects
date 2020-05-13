<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRelatedProductsTable extends Migration {

	public function up()
	{
		Schema::create('related_products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('product_id')->unsigned();
			$table->integer('related_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('related_products');
	}
}