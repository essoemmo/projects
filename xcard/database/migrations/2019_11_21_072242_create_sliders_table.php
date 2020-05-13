<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlidersTable extends Migration {

	public function up()
	{
		Schema::create('sliders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('image', 191)->nullable();
			$table->mediumText('url')->nullable();
			$table->boolean('publish')->default(false);
		});
	}

	public function down()
	{
		Schema::drop('sliders');
	}
}