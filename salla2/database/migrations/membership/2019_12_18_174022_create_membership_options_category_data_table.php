<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembershipOptionsCategoryDataTable extends Migration {

	public function up()
	{
		Schema::create('membership_options_category_data', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('lang_id')->unsigned();
			$table->integer('categoty_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('membership_options_category_data');
	}
}