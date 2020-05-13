<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatDatasTable extends Migration
{

    public function up()
    {
        Schema::create('chat__datas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('chat_id')->unsigned();
            $table->integer('lang_id')->unsigned();
            $table->integer('source_id')->unsigned()->nullable();

            $table->foreign('chat_id')->references('id')->on('chats')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('lang_id')->references('id')->on('languages')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('source_id')->references('id')->on('chat__datas')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chat__datas');
    }
}
