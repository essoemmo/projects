<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('settings_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('setting_id')->unsigned()->nullable();
			$table->string('title', 191)->nullable();
			$table->text('address')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
			$table->string('locale', 191);
		});
	}

	public function down()
	{
		Schema::drop('settings_translations');
	}
}
