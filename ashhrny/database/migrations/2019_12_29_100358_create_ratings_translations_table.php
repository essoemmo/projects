<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('rating_id')->nullable();
            $table->string('title')->nullable();
            $table->string('locale')->nullable();
            $table->timestamps();

            $table->foreign('rating_id')->references('id')->on('ratings')
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
        Schema::dropIfExists('ratings_translations');
    }
}
