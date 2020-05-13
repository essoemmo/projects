<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoCategoriesTable extends Migration {

	public function up()
	{
		Schema::dropIfExists('co_categories');
		Schema::create('co_categories', function(Blueprint $table) {
			$table->increments('id');
			$table->string('cat_name', 150);
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('lang_id')->unsigned()->nullable();
            $table->integer('source_id')->unsigned()->nullable();
			$table->timestamps();

            $table->foreign('parent_id')->references('id')->on('co_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('lang_id')->references('id')->on('languages')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('source_id')->references('id')->on('co_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::drop('co_categories');
	}
}