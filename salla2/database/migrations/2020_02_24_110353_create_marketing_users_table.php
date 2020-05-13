<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketingUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketing_users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('marketing_id')->nullable();
            $table->string('code' , 50);
            $table->string('value' ,50)->nullable();
            $table->integer('store_id')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('marketing_id')->references('id')->on('marketing')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('marketing_users');
    }
}
