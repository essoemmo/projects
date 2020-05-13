<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNewslettersTable extends Migration {

	public function up()
	{
		Schema::create('newsletters', function(Blueprint $table) {
			$table->increments('id');
            $table->string('email', 191)->nullable();
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('newsletters');
	}
}