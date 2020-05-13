<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlidersTable extends Migration {

	public function up()
	{
		Schema::create('sliders', function(Blueprint $table) {
			$table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->tinyInteger('sort')->nullable();
            $table->string('alt_image', 191)->nullable();
            $table->boolean('publish')->default(false);
            //$table->string('image', 191)->nullable();
            // $table->mediumText('url')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
	}

	public function down()
	{
		Schema::drop('sliders');
	}
}
