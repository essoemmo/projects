<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLanguagesTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('languages_translations', function(Blueprint $table) {
			$table->increments('id');
            $table->string('title', 191)->nullable();
            $table->integer('language_id')->unsigned()->nullable();
            $table->string('locale', 191);
            $table->timestamps();

            $table->foreign('language_id')->references('id')->on('languages')
                ->onDelete('cascade')
                ->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::drop('languages_translations');
	}
}
