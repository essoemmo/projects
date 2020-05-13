<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentSectionsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_sections_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('section_id')->unsigned()->nullable();
            $table->unsignedInteger("lang_id")->nullable();
            $table->unsignedInteger('source_id')->nullable();
            $table->text('content');
            $table->timestamps();

            $table->foreign('section_id')->references('id')->on('content_sections')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('lang_id')
                ->references('id')->on('languages')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('source_id')->references('id')->on('content_sections_data')
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
        Schema::dropIfExists('content_sections_data');
    }
}
