<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentSectionsProductsTable extends Migration {

	public function up()
	{
		Schema::create('content_sections_products', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('content_section_id')->unsigned()->nullable();
            $table->integer('product_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('content_section_id')->references('id')->on('content_sections')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
	}

	public function down()
	{
		Schema::drop('content_sections_products');
	}
}