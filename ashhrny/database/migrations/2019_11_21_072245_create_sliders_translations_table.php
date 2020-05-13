<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlidersTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('sliders_translations', function(Blueprint $table) {
			$table->increments('id');
            $table->integer('slider_id')->unsigned()->nullable();
            $table->string('title', 191)->nullable();
            //$table->text('description')->nullable();
            $table->string('locale', 191);
            $table->timestamps();

            $table->foreign('slider_id')->references('id')->on('sliders')
                ->onDelete('cascade')
                ->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::drop('sliders_translations');
	}
}
