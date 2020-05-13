<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateBankTransfersTable extends Migration {

	public function up()
	{
		Schema::create('bank_transfers', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 50);
			$table->integer('lang_id')->unsigned()->nullable();
			$table->text('description');
			$table->timestamps();

            $table->foreign('lang_id')->references('id')->on('languages')
                ->onDelete('cascade')
                ->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::drop('bank_transfers');
	}
}