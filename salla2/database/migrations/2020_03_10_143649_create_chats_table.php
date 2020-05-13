<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{

    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('avatar');
            $table->longText('script');
            $table->boolean('published')->default(0);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('chats');
    }
}
