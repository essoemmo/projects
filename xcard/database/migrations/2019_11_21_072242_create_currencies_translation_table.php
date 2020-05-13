<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCurrenciesTranslationTable extends Migration {

	public function up()
	{
		Schema::create('currencies_translation', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title', 191)->nullable();
			$table->string('code', 191)->nullable();
			$table->integer('currency_id')->unsigned()->nullable();
			$table->string('locale', 191);
		});
	}

	public function down()
	{
		Schema::drop('currencies_translation');
	}
}
