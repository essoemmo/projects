<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailTemplatesDataTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_templates_data_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('email_template_data_id');
            $table->string('subject');
            $table->text('body');
            $table->string('locale', 50)->nullable();

            $table->foreign('email_template_data_id')->references('id')->on('email_templates_data')
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
        Schema::dropIfExists('email_templates_data_translations');
    }
}
