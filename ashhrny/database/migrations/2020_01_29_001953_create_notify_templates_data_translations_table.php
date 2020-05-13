<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifyTemplatesDataTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notify_templates_data_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('notify_data_id');
            $table->string('subject');
            $table->text('body');
            $table->string('locale', 50)->nullable();

            $table->foreign('notify_data_id')->references('id')->on('notify_templates_data')
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
        Schema::dropIfExists('notify_templates_data_translations');
    }
}
