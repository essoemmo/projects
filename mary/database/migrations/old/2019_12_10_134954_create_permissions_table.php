<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermissionsTable extends Migration {

	public function up()
	{
		Schema::create('permissions', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 191);
			$table->string('guard_name', 191);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('permissions');
	}
}