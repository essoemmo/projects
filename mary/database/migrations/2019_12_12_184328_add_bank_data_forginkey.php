<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBankDataForginkey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank_data', function(Blueprint $table) {
            $table->bigInteger('lang_id')->unsigned();
            $table->integer('source_id')->unsigned()->nullable();

            $table->foreign('lang_id')
                ->references('id')->on('languages');

            $table->foreign('source_id')
                ->references('id')->on('banks')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
