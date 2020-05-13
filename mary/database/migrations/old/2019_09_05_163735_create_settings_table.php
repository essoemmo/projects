<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('email')->nullable();
            $table->string('loge')->nullable();
            $table->bigInteger('lang_id')->unsigned()->nullable();
            $table->foreign('lang_id')->references('id')->on('languages')->onDelete('cascade')->onUpdate('cascade');


            $table->bigInteger('source_id')->unsigned()->nullable();
            $table->foreign('source_id')->references('id')->on('settings')->onDelete('cascade')->onUpdate('cascade');

            $table->text('register_msg ')->nullable();
            $table->string('TitleTopSearch ')->nullable();
            $table->text('descriptionOnSearch ')->nullable();

            $table->string('Titleactivemember ')->nullable();
            $table->text('descrptionactivemember ')->nullable();

            $table->string('Titleactivemember2 ')->nullable();
            $table->text('descrptionactivemember2 ')->nullable();

            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('phone1')->nullable();
            $table->string('address')->nullable();
            $table->string('description')->nullable();
            $table->integer('mantance')->default(1);
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
        Schema::dropIfExists('settings');
    }
}
