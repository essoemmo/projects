<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentSectionsTable extends Migration {

	public function up()
	{
		Schema::create('content_sections', function(Blueprint $table) {
			$table->increments('id');
            $table->string('title', 191)->nullable();
            $table->tinyInteger('order');
            $table->tinyInteger('columns');
            $table->enum('type', array('home', 'footer'));
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('content_sections');
	}
}