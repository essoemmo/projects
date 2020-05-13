<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactionsTable extends Migration {

	public function up()
	{
		Schema::create('transactions', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->enum('status', array('pending', 'paid', 'refused'));
			$table->integer('bank_id')->unsigned();
			$table->string('bank_transactions_num', 191);
			$table->integer('total');
			$table->string('image', 191);
			$table->string('currency', 191)->nullable();
			$table->string('holder_name', 191)->nullable();
			$table->string('holder_card_number', 191)->nullable();
			$table->integer('holder_cvc')->nullable();
			$table->integer('holder_expire');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('transactions');
	}
}