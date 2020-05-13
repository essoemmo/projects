<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailTemplatesDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_templates_data', function (Blueprint $table) {
            $table->increments('id');
            $table->string('from_email');
            $table->unsignedInteger('email_template_id');
            $table->timestamps();

            $table->foreign('email_template_id')->references('id')->on('email_templates')
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
        Schema::dropIfExists('email_templates_data');
    }
}
