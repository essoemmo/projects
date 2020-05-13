<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBankDataTable extends Migration {

	public function up()
	{
		Schema::create('bank_data', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 191);
			$table->timestamps();
			$table->Integer('bank_id')->unsigned();

		});
	}

	public function down()
	{
		Schema::drop('bank_data');
	}
}