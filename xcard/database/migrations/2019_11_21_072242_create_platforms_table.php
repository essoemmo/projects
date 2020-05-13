<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlatformsTable extends Migration {

	public function up()
	{
		Schema::create('platforms', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('image', 191)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('platforms');
	}
}