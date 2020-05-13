<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('membership_options_master', function(Blueprint $table) {
			$table->foreign('categoty_id')->references('id')->on('membership_options_category')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('Membership_options_data', function(Blueprint $table) {
			$table->foreign('option_id')->references('id')->on('membership_options_master')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('membership_option_perms', function(Blueprint $table) {
			$table->foreign('option_id')->references('id')->on('membership_options_master')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('membership_options', function(Blueprint $table) {
			$table->foreign('option_id')->references('id')->on('membership_options_master')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('membership_options_category_data', function(Blueprint $table) {
			$table->foreign('categoty_id')->references('id')->on('membership_options_category')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('membership_options_master', function(Blueprint $table) {
			$table->dropForeign('membership_options_master_categoty_id_foreign');
		});
		Schema::table('Membership_options_data', function(Blueprint $table) {
			$table->dropForeign('Membership_options_data_option_id_foreign');
		});
		Schema::table('membership_option_perms', function(Blueprint $table) {
			$table->dropForeign('membership_option_perms_option_id_foreign');
		});
		Schema::table('membership_options', function(Blueprint $table) {
			$table->dropForeign('membership_options_option_id_foreign');
		});
		Schema::table('membership_options_category_data', function(Blueprint $table) {
			$table->dropForeign('membership_options_category_data_categoty_id_foreign');
		});
	}
}