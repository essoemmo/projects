<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlogsTable extends Migration {

	public function up()
	{
        Schema::create('blogs', function(Blueprint $table) {
            $table->increments('id');
            $table->string('image', 191)->nullable();
            $table->string('alt_image', 191)->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->boolean('publish')->default(false);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('blog_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::drop('blogs');
	}
}
