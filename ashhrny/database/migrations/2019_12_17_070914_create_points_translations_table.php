<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('point_id')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('locale', 50);
            $table->timestamps();

            $table->foreign('point_id')->references('id')->on('points')
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
        Schema::dropIfExists('points_translations');
    }
}
