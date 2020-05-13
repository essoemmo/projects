<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactSectionTable extends Migration {

	public function up()
	{
		Schema::create('contact_section', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 100)->nullable();
			$table->integer('columns');
			$table->integer('order');
			$table->enum('system_type', array('main', 'single'));
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('contact_section');
	}
}