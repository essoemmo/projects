<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTagTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('tag_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('tag_id')->unsigned()->nullable();
			$table->string('title', 191)->nullable();
			$table->string('locale', 191);
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->foreign('tag_id')->references('id')->on('tags')
                ->onDelete('cascade')
                ->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::drop('tag_translations');
	}
}
