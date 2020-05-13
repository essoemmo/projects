<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentSectionsTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('content_sections_translations', function(Blueprint $table) {
			$table->increments('id');
            $table->integer('content_section_id')->unsigned()->nullable();
            $table->text('content')->nullable();
            $table->string('locale', 100);
            $table->timestamps();

            $table->foreign('content_section_id')->references('id')->on('content_sections')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
	}

	public function down()
	{
		Schema::drop('content_sections_translations');
	}
}
