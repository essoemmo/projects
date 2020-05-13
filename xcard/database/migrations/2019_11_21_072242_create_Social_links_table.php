<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSocialLinksTable extends Migration {

	public function up()
	{
		Schema::create('Social_links', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title', 191)->nullable();
			$table->mediumText('url')->nullable();
			$table->integer('setting_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('Social_links');
	}
}