<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoryDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('story_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('content');

            $table->bigInteger('lang_id')->unsigned();
            $table->foreign('lang_id')->references('id')->on('languages');

            $table->bigInteger('stories_id')->unsigned();
            $table->foreign('stories_id')->on('stories')->references('id')
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE')
            ;
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
        Schema::dropIfExists('story_datas');
    }
}
