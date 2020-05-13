<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembershipOptionsMasterTable extends Migration {

	public function up()
	{
		Schema::create('membership_options_master', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('categoty_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('membership_options_master');
	}
}