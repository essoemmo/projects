<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->unsignedInteger('avertisement_type_id')->nullable(); // advertisement type (ex: commercial type)
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->string('image')->nullable();
            $table->string('alt_image')->nullable();
            $table->string('video')->nullable();
            $table->string('alt_video')->nullable();
            $table->enum('advertise_type' , ['website' , 'user'])->nullable(); // if advertise on => ('website' or 'famous user')
            $table->unsignedInteger('advertise_on')->nullable(); // advertise_on => is (user_id or setting_id)
            $table->timestamps();

            $table->foreign('advertise_on')->references('id')->on('users')
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
        Schema::dropIfExists('advertisements');
    }
}
