<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialLinkSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_link_setting', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 191)->nullable();
            $table->mediumText('url')->nullable();
            $table->string('icon')->nullable();
            $table->integer('setting_id')->unsigned()->nullable();
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
        Schema::dropIfExists('social_link_setting');
    }
}
