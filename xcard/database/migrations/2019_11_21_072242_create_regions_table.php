<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegionsTable extends Migration {

	public function up()
	{
		Schema::create('regions', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('code', 191)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('regions');
	}
}