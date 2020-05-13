<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePhonesTable extends Migration {

	public function up()
	{
		Schema::create('phones', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('phone', 191)->nullable();
			$table->integer('phoneable_id')->unsigned()->nullable();
			$table->string('phoneable_type', 191)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('phones');
	}
}