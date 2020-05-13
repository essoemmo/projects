<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentSectionsProductsTable extends Migration {

	public function up()
	{
		Schema::create('content_sections_products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('content_section_id')->unsigned()->nullable();
			$table->integer('product_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('content_sections_products');
	}
}