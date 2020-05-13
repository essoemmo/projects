<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountCodesTargetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_codes_target', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('discount_id')->nullable();
            $table->integer('item_id')->nullable();
            $table->enum('model_type' , ["products","category"]);
            $table->timestamps();

            $table->foreign('discount_id')->references('id')->on('discount_codes')
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
        Schema::dropIfExists('discount_codes_target');
    }
}
