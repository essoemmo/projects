<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGameDetailsProductsTable extends Migration {

	public function up()
	{
		Schema::create('gameDetails_products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('game_detail_id')->unsigned()->nullable();
			$table->integer('product_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('gameDetails_products');
	}
}
