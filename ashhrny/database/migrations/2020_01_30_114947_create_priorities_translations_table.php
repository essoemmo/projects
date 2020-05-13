<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrioritiesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('priorities_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('priority_id');
            $table->string('title');
            $table->string('locale', 50);

            $table->foreign('priority_id')->references('id')->on('priorities')
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
        Schema::dropIfExists('priorities_translations');
    }
}
