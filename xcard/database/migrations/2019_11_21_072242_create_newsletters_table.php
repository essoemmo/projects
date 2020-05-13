<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNewslettersTable extends Migration {

	public function up()
	{
		Schema::create('newsletters', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('email', 191)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('newsletters');
	}
}