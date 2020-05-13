<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlogTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('blog_translations', function(Blueprint $table) {
			$table->increments('id');
            $table->unsignedInteger('blog_id')->nullable();
            $table->string('title', 191)->nullable();
            $table->text('content')->nullable();
            $table->string('locale', 191);
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();

            $table->foreign('blog_id')->references('id')->on('blogs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::drop('blog_translations');
	}
}
