<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlogsTagsTable extends Migration {

	public function up()
	{
		Schema::create('blogs_tags', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('tag_id')->unsigned()->nullable();
			$table->integer('blog_id')->unsigned()->nullable();
            $table->foreign('blog_id')->references('id')->on('blogs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')
                ->onDelete('cascade')
                ->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::drop('blogs_tags');
	}
}
