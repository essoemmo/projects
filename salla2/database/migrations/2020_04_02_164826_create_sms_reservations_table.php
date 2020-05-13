<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sender_name');
            $table->string('sender_ad_name');
            $table->string('company_name');
            $table->string('commercial_register');
            $table->string('store_owner_name');
            $table->string('store_title');
            $table->unsignedInteger('store_id');
            $table->timestamps();

            $table->foreign('store_id')->references('id')->on('stores')
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
        Schema::dropIfExists('sms_reservations');
    }
}
