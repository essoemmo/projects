<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorksOnTable extends Migration {

	public function up()
	{
		Schema::create('works_on', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('icon', 191)->nullable();
			$table->string('title', 191)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('works_on');
	}
}