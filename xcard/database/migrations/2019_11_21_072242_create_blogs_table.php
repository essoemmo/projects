<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlogsTable extends Migration {

	public function up()
	{
		Schema::create('blogs', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('image', 191)->nullable();
			$table->integer('category_id')->unsigned()->nullable();
			$table->boolean('publish')->default(false);
		});
	}

	public function down()
	{
		Schema::drop('blogs');
	}
}