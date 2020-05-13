<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialAdvertisementUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_advertisement_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('orderNumber');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('social_link_id')->nullable();
            $table->unsignedInteger('famous_id')->nullable();
            $table->unsignedInteger('account_type_id')->nullable();
            $table->enum('advert_type',['website','user'])->nullable();
            $table->string('file')->nullable();
            $table->text('content')->nullable();
            $table->boolean('publish')->default(0);
            $table->decimal('price')->nullable();
            $table->string('duration')->nullable();
            $table->decimal('total')->nullable();
            $table->dateTime('from')->nullable();
            $table->dateTime('to')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('famous_id')->references('id')->on('users')
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
        Schema::dropIfExists('social_advertisement_user');
    }
}
