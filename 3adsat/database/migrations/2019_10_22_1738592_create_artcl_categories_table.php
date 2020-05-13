<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtclCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('artcl_categories', function(Blueprint $table) {
			$table->increments('id');
//			$table->integer('store_id')->unsigned();
			$table->integer('source_id')->unsigned()->nullable();
			$table->integer('lang_id')->unsigned()->nullable();
			$table->string('title', 150);
            $table->boolean('published')->nullable()->default(0);
			$table->string('img_url', 250)->nullable();
			$table->date('created')->nullable();
            $table->timestamps();

//			$table->foreign('store_id')->references('id')->on('stores')
//				->onDelete('cascade')
//				->onUpdate('cascade');

			$table->foreign('source_id')->references('id')->on('articles')
				->onDelete('cascade')
				->onUpdate('cascade');

			$table->foreign('lang_id')->references('id')->on('languages')
				->onDelete('cascade')
				->onUpdate('cascade');


		});
	}

	public function down()
	{
		Schema::drop('artcl_categories');
	}
}