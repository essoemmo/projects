<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDiscountCodesTable extends Migration {

	public function up()
	{
		Schema::create('discount_codes', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title', 191);
			$table->string('code', 191);
			$table->double('discount', 8.2)->nullable();
			$table->tinyInteger('count')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('discount_codes');
	}
}