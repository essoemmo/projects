<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSocialLinksTable extends Migration {

	public function up()
	{
		Schema::create('social_links', function(Blueprint $table) {
			$table->increments('id');
            $table->string('icon')->nullable();
//            $table->mediumText('url')->nullable();
//            $table->string('default_social_url')->nullable(); // default social link to user
           // $table->integer('setting_id')->unsigned()->nullable();
            $table->timestamps();

//            $table->foreign('setting_id')->references('id')->on('settings')
//                ->onDelete('cascade')
//                ->onUpdate('cascade');
        });
	}

	public function down()
	{
		Schema::drop('Social_links');
	}
}