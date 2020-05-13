<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembershipOptionsDataTable extends Migration {

	public function up()
	{
		Schema::create('Membership_options_data', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('option_id')->unsigned();
			$table->string('title', 100);
			$table->integer('lang_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('Membership_options_data');
	}
}