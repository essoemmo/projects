<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembershipOptionsTable extends Migration {

	public function up()
	{
		Schema::create('membership_options', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('membership_type_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('membership_options');
	}
}