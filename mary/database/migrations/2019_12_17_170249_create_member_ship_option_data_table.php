<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberShipOptionDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_option_data', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('membership_option_id')->unsigned();
            $table->foreign('membership_option_id')->references('id')->on('membership_options')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('name');
            $table->bigInteger('lang_id')->unsigned();
            $table->foreign('lang_id')->references('id')->on('languages');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_ship_option_data');
    }
}
