<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentSectionDataTable extends Migration {

	public function up()
	{
		Schema::create('content_section_data', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('section_id')->unsigned();
			$table->integer('lang_id')->unsigned();
			$table->integer('source_id')->nullable();
			$table->text('content')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('content_section_data');
	}
}