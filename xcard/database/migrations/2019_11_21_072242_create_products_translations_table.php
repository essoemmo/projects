<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('products_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('product_id')->unsigned()->nullable();
			$table->string('title', 191)->nullable();
			$table->text('description')->nullable();
			$table->text('System_requirements')->nullable();
            $table->string('locale', 191);
		});
	}

	public function down()
	{
		Schema::drop('products_translations');
	}
}
