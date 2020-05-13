<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 150)->nullable();
			$table->string('email', 100);
			$table->string('phone', 15)->nullable();
            //$table->integer('country_id')->unsigned()->nullable();
			$table->text('message');
			$table->timestamps();


//            $table->foreign('country_id')->references('id')->on('countries')
//                ->onDelete('cascade')
//                ->onUpdate('cascade');

		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}