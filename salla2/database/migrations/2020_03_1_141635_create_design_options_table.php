<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDesignOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_options', function (Blueprint $table) {
            $table->increments('id');
            //$table->unsignedInteger('setting_id');
            $table->unsignedInteger('store_id')->nullable();
            $table->string('color' , 50)->nullable();
            $table->string('font' , 50)->nullable();
            $table->enum('main_menu' , ['classification_list' , 'custom_list'])->nullable(); // if custom_list => go to table (custom_design_options)& set option_type => custom_list
            $table->enum('home_page_display' , ['latest_product' , 'custom_design'])->nullable(); // if custom_design => go to table (custom_design_options)& set option_type => custom_design
            $table->boolean('navigation_path')->default(0)->nullable();
            $table->boolean('show_all_button')->default(0)->nullable();
            $table->boolean('display_charge_indicator')->default(0)->nullable();
            $table->timestamps();

            $table->foreign('store_id')->references('id')->on('stores')
                ->onDelete('cascade')
                ->onUpdate('cascade');

//            $table->foreign('setting_id')->references('id')->on('settings')
//                ->onDelete('cascade')
//                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('design_options');
    }
}
