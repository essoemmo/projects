<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembershipOptionsTable extends Migration {

	public function up()
	{
		Schema::create('membership_options', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('membership_id')->unsigned();
			$table->integer('option_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('membership_options');
	}
}