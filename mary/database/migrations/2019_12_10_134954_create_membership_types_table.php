<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembershipTypesTable extends Migration {

	public function up()
	{
		Schema::create('membership_types', function(Blueprint $table) {
			$table->increments('id');
			$table->string('image', 191)->nullable();
			$table->timestamps();
			$table->enum('type', array('male', 'female','together'));
			$table->integer('price');
			$table->date('expire_date');
		});
	}

	public function down()
	{
		Schema::drop('membership_types');
	}
}