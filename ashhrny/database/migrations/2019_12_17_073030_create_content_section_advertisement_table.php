<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentSectionAdvertisementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_section_advertisement', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('content_section_id')->unsigned()->nullable();
            $table->unsignedBigInteger('advertisement_id')->unsigned();
            $table->timestamps();

            $table->foreign('content_section_id')->references('id')->on('content_sections')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('advertisement_id')->references('id')->on('advertisements')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_section_advertisement');
    }
}
