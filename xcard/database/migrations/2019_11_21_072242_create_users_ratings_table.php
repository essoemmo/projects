<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersRatingsTable extends Migration {

	public function up()
	{
		Schema::create('users_ratings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id')->unsigned();
			$table->integer('rating')->nullable();
			$table->text('comment')->nullable();
			$table->tinyInteger('approve')->nullable()->default('0');
			$table->integer('ra_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('users_ratings');
	}
}