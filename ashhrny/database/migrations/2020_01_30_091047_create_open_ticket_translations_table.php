<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpenTicketTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('open_ticket_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('open_ticket_id');
            $table->string('title');
            $table->text('description');
            $table->string('locale', 50);

            $table->foreign('open_ticket_id')->references('id')->on('open_ticket')
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
        Schema::dropIfExists('open_ticket_translations');
    }
}
