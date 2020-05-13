<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGameDetailsTable extends Migration {

	public function up()
	{
		Schema::create('Game_details', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('image', 191)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('Game_details');
	}
}