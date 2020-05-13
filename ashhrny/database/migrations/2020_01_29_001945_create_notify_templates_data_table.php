<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifyTemplatesDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notify_templates_data', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('notify_template_id');
            $table->timestamps();

            $table->foreign('notify_template_id')->references('id')->on('notify_templates')
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
        Schema::dropIfExists('notify_templates_data');
    }
}
