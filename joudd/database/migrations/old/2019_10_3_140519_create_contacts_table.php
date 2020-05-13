<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 150);
			$table->string('email', 100);
			$table->string('title')->nullable();
			$table->text('message');
			$table->timestamps();

		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}