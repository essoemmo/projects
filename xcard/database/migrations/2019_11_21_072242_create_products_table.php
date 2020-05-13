<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('main_image', 191)->nullable();
			$table->integer('quantity')->nullable();
//			$table->string('code', 191)->nullable();
//			$table->string('video', 191)->nullable();
            $table->decimal('price')->nullable();
			$table->date('release_date')->nullable();
			$table->string('developers', 191)->nullable();
			$table->string('publishers', 191)->nullable();
			$table->integer('works_on_id')->unsigned()->nullable();
			$table->integer('platform_id')->unsigned()->nullable();
			$table->integer('region_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}
