<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('email', 191)->nullable();
			$table->string('logo', 191)->nullable();
			$table->string('footer_logo', 191)->nullable();
			$table->time('work_time')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}