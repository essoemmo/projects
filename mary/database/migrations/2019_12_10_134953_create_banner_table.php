<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBannerTable extends Migration {

	public function up()
	{
		Schema::create('banner', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('section_id')->unsigned();
			$table->date('start_date');
			$table->date('end_date');
			$table->string('image', 191);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('banner');
	}
}