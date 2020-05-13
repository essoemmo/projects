<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('first_name', 191)->nullable();
			$table->string('last_name', 191)->nullable();
			$table->string('email', 191);
			$table->timestamp('email_verified_at')->nullable();
			$table->string('image', 191)->nullable();
			$table->string('guard', 191)->default('web');
			$table->string('mobile', 191)->nullable();
			$table->string('password', 191);
			$table->integer('country_id')->unsigned()->nullable();
			$table->integer('site_language_id')->unsigned()->nullable();
			$table->string('provider', 191)->nullable();
			$table->string('provider_id', 191)->nullable();
			$table->string('remember_token', 100)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}
