<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_datas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('sms_id')->unsigned();
            $table->foreign('sms_id')->references('id')->on('sms')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->text('message')->nullable();
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
        Schema::dropIfExists('sms_datas');
    }
}
