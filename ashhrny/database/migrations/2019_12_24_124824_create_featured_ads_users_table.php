<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturedAdsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('featured_ads_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('orderNumber');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('featured_id')->nullable();
            $table->enum('featured_type' , ['slider','featured'])->nullable();
            $table->boolean('publish')->default(0);
            $table->unsignedInteger('social_link_id')->nullable();
            $table->string('duration')->nullable();
            $table->decimal('price')->nullable();
            $table->decimal('total')->nullable();
            $table->dateTime('from')->nullable();
            $table->dateTime('to')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('featured_id')->references('id')->on('featured_ads')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('social_link_id')->references('id')->on('social_link_user')
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
        Schema::dropIfExists('featured_ads_users');
    }
}
