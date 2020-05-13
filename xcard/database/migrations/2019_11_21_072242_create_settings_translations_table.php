<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('settings_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('setting_id')->unsigned()->nullable();
			$table->string('title', 191)->nullable();
			$table->text('address')->nullable();
			$table->text('description')->nullable();
			$table->string('locale', 191);
		});
	}

	public function down()
	{
		Schema::drop('settings_translations');
	}
}
