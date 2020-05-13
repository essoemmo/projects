<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketing', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('message')->nullable();
            $table->string('url_item')->nullable();
            $table->enum('type' , ['store','product','category','offers']);
            $table->tinyInteger('apply_all_conditions')->default(1);
            $table->string('campaign_target' ,50)->nullable();
            $table->string('campaign_target_value' , 50)->nullable();
            $table->time('campaign_time')->nullable();
            $table->date('campaign_date')->nullable();
            $table->tinyInteger('is_draft')->default(0); //  select save => 0 if select draft => 1
            $table->integer('store_id')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('store_id')->references('id')->on('stores')
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
        Schema::dropIfExists('marketing');
    }
}
