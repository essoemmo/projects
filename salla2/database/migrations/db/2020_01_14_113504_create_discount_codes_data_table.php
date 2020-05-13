<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountCodesDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_codes_data', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('discount_code_id')->nullable();
            $table->string('title');
            $table->unsignedInteger('lang_id')->nullable();
            $table->unsignedInteger('source_id')->nullable();

            $table->foreign('lang_id')->references('id')->on('store_languages')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('source_id')->references('id')->on('discount_codes')
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
        Schema::dropIfExists('discount_codes_data');
    }
}
