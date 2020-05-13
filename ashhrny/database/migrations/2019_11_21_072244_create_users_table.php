<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
        Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('membership_number');
            $table->string('first_name', 191)->nullable();
            $table->string('last_name', 191)->nullable();
            $table->string('email', 191);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('image', 191)->nullable();
            $table->string('alt_image', 191)->nullable();
            $table->string('guard', 191)->default('web');
            $table->enum('user_type' ,['normal' ,'famous' ,'admin'])->nullable();
            $table->enum('gender' ,['male' ,'female'])->default('male');
            $table->string('job_type')->nullable(); // work type of famous (ex: actor)
            $table->boolean('status' )->default(1);
            $table->string('identify_number', 20)->nullable();
            $table->mediumText('identify_image')->nullable();
            $table->string('mobile', 191)->nullable();
            $table->string('password', 191);
            $table->integer('country_id')->unsigned()->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->string('provider', 191)->nullable();
            $table->string('provider_id', 191)->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('city_id')->references('id')->on('cities')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });
    }

	public function down()
	{
		Schema::drop('users');
	}
}
