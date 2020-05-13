<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFooterTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footer_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('footer_id')->nullable();
            $table->string('title')->nullable();
            $table->string('locale', 50)->nullable();
            $table->timestamps();

            $table->foreign('footer_id')->references('id')->on('footer')
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
        Schema::dropIfExists('footer_translations');
    }
}
