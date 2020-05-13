<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNationaliesDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nationalies_data', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('county_name');

            $table->bigInteger('nationalty_id')->unsigned();
            $table->foreign('nationalty_id')->references('id')->on('nationalties')->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('lang_id')->unsigned();
            $table->foreign('lang_id')->references('id')->on('languages')->onDelete('cascade')->onUpdate('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nationalies_data');
    }
}
