<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration {

	public function up()
	{
		Schema::create('articles', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('category_id')->unsigned();
//			$table->integer('store_id')->unsigned();
			$table->string('title', 150);
			$table->string('img_url', 250)->nullable();
			$table->text('content')->nullable();
			$table->boolean('published')->nullable()->default(0);
			$table->date('created')->nullable();
            $table->unsignedInteger('lang_id')->nullable();
            $table->unsignedInteger('source_id')->nullable();
            $table->timestamps();
            $table->foreign('lang_id')->references('id')->on('languages')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('source_id')->references('id')->on('articles')
                ->onDelete('cascade')
                ->onUpdate('cascade');

//			$table->foreign('category_id')->references('id')->on('artcl_categories')
//				->onDelete('cascade')
//				->onUpdate('cascade');
//
//			$table->foreign('store_id')->references('id')->on('stores')
//				->onDelete('cascade')
//				->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::drop('articles');
	}
}