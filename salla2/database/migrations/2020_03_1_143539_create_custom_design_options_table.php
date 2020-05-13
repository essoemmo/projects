<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomDesignOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_design_options', function (Blueprint $table) {
            $table->increments('id');
            // $table->unsignedInteger('option_id')->nullable();
            $table->integer('store_id')->unsigned()->nullable();
            $table->enum('option_type' , ['custom_list' ,'custom_design']);
            $table->string('code', 50)->nullable();
            $table->string('value')->nullable();
            $table->string('additional_value')->nullable();
            $table->string('title')->nullable();
            $table->string('value_type')->nullable();
            $table->tinyInteger('integer_value')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();

//            $table->foreign('option_id')->references('id')->on('design_options')
//                ->onDelete('cascade')
//                ->onUpdate('cascade');

            $table->foreign('store_id')->references('id')->on('stores')
                ->onDelete('cascade')
                ->onUpdate('cascade');

//            $table->string('type',50)->nullable();
//            $table->string('value')->nullable();
//            $table->string('sub_value')->nullable();
//            $table->string('value_type')->nullable();
//            $table->string('code')->nullable();
//            $table->tinyInteger('number')->nullable();
//            $table->boolean('open_separate_window')->default(0)->nullable();
//            $table->boolean('background_transparent')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_design_options');
    }
}
