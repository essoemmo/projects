<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCurrenciesTable extends Migration {

	public function up()
	{
		Schema::create('currencies', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('country_id')->unsigned()->nullable()->index();
		});
	}

	public function down()
	{
		Schema::drop('currencies');
	}
}