<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegionsTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('regions_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('region_id')->unsigned()->nullable();
			$table->string('title', 191)->nullable();
			$table->string('locale', 191);
		});
	}

	public function down()
	{
		Schema::drop('regions_translations');
	}
}
