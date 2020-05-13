<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateNewslettersTable extends Migration {

	public function up()
	{
		Schema::create('newsletters', function(Blueprint $table) {
			$table->increments('id');
			$table->string('email', 100);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('newsletters');
	}
}