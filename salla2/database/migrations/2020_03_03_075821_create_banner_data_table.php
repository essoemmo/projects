<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('banner_id')->unsigned()->nullable();
            $table->integer('lang_id')->unsigned()->nullable();
            $table->integer('source_id')->unsigned()->nullable();
            $table->string('name', 150);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('banner_id')->references('id')->on('banners')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('lang_id')->references('id')->on('languages')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('source_id')->references('id')->on('banners_data')
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
        Schema::dropIfExists('banners_data');
    }
}
