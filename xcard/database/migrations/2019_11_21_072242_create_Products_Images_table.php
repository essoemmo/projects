<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsImagesTable extends Migration {

	public function up()
	{
		Schema::create('Products_Images', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('product_id')->unsigned();
			$table->string('image', 191)->nullable();
			$table->tinyInteger('sort_order')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('Products_Images');
	}
}