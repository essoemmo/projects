<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanksTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bank_id')->nullable();
            $table->string('title')->nullable();
            $table->string('locale')->nullable();

            $table->foreign('bank_id')->references('id')->on('banks')
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
        Schema::dropIfExists('banks_translations');
    }
}
