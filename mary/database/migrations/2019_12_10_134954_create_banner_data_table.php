<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBannerDataTable extends Migration {

	public function up()
	{
		Schema::create('banner_data', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('banner_id')->unsigned();
			$table->string('title', 191);
			$table->text('description')->nullable();
			$table->integer('lang_id');
			$table->integer('source_id')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('banner_data');
	}
}