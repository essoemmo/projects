<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentSectionBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_section_banners', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('content_section_id');
            $table->unsignedInteger('banner_id');
            $table->timestamps();

            $table->foreign('content_section_id')->references('id')->on('content_sections')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('banner_id')->references('id')->on('banners')
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
        Schema::dropIfExists('content_section_banners');
    }
}
