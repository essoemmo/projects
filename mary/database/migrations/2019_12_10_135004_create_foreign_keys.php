<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('banner', function(Blueprint $table) {
			$table->foreign('section_id')->references('id')->on('contact_section')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('content_section_data', function(Blueprint $table) {
			$table->foreign('section_id')->references('id')->on('contact_section')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('banner_data', function(Blueprint $table) {
			$table->foreign('banner_id')->references('id')->on('banner')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('membership_data_types', function(Blueprint $table) {
			$table->foreign('memberShip_type_id')->references('id')->on('membership_types')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('permissions_memberships', function(Blueprint $table) {
			$table->foreign('permision_id')
                ->references('id')->on('permissions')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('permissions_memberships', function(Blueprint $table) {
			$table->foreign('memberShip_type_id')->references('id')->on('membership_types')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('bank_data', function(Blueprint $table) {
			$table->foreign('bank_id')->references('id')->on('banks')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('transactions', function(Blueprint $table) {
			$table->foreign('bank_id')->references('id')->on('banks')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('membership_options', function(Blueprint $table) {
			$table->foreign('membership_type_id')->references('id')->on('membership_types')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('banner', function(Blueprint $table) {
			$table->dropForeign('banner_section_id_foreign');
		});
		Schema::table('content_section_data', function(Blueprint $table) {
			$table->dropForeign('content_section_data_section_id_foreign');
		});
		Schema::table('banner_data', function(Blueprint $table) {
			$table->dropForeign('banner_data_banner_id_foreign');
		});
		Schema::table('membership_data_types', function(Blueprint $table) {
			$table->dropForeign('membership_data_types_memberShip_type_id_foreign');
		});
		Schema::table('permissions_memberships', function(Blueprint $table) {
			$table->dropForeign('permissions_memberships_permision_id_foreign');
		});
		Schema::table('permissions_memberships', function(Blueprint $table) {
			$table->dropForeign('permissions_memberships_memberShip_type_id_foreign');
		});
		Schema::table('bank_data', function(Blueprint $table) {
			$table->dropForeign('bank_data_bank_id_foreign');
		});
		Schema::table('transactions', function(Blueprint $table) {
			$table->dropForeign('transactions_bank_id_foreign');
		});
		Schema::table('membership_options', function(Blueprint $table) {
			$table->dropForeign('membership_options_membership_type_id_foreign');
		});
	}
}