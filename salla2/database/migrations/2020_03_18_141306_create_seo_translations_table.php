<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();

            $table->integer('seo_id')->unsigned();
            $table->integer('lang_id')->unsigned();
            $table->integer('source_id')->unsigned()->nullable();

            $table->foreign('seo_id')->references('id')->on('seo')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('lang_id')->references('id')->on('languages')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('source_id')->references('id')->on('seo_translations')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('seo_translations');
    }
}
