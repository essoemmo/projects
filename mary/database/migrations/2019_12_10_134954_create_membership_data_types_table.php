<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembershipDataTypesTable extends Migration {

	public function up()
	{
		Schema::create('membership_data_types', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('memberShip_type_id')->unsigned();
			$table->string('name', 191);
			$table->text('description')->nullable();
			$table->integer('lang_id');
			$table->integer('source_id')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('membership_data_types');
	}
}