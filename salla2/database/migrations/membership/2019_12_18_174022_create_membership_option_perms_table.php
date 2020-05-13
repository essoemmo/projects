<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembershipOptionPermsTable extends Migration {

	public function up()
	{
		Schema::create('membership_option_perms', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('perm_id')->unsigned()->nullable();
			$table->integer('option_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('membership_option_perms');
	}
}