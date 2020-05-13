<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCurrenciesTranslationTable extends Migration {

	public function up()
	{
		Schema::create('currencies_translation', function(Blueprint $table) {
			$table->increments('id');
            $table->string('title', 191)->nullable();
            $table->string('code', 191)->nullable();
            $table->integer('currency_id')->unsigned()->nullable();
            $table->string('locale', 191);
            $table->timestamps();

            $table->foreign('currency_id')->references('id')->on('currencies')
                ->onDelete('cascade')
                ->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::drop('currencies_translation');
	}
}
