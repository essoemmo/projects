<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('send_email')->default(0);
            $table->boolean('send_sms')->default(0);
            $table->boolean('send_section')->default(0);
            $table->boolean('normal_user_register')->default(0);
            $table->boolean('famous_user_register')->default(0);
            $table->boolean('register_section')->default(0);
            $table->boolean('famous_section')->default(0);
            $table->boolean('famous_ads_front')->default(0);
            $table->boolean('famous_ads_menu')->default(0);
            $table->boolean('identification_number')->default(0);
            $table->boolean('identification_image')->default(0);
            $table->boolean('myAccounts_menu')->default(0);
            $table->boolean('myAds_menu')->default(0);
            $table->boolean('featuredAd_menu')->default(0);
            $table->boolean('AdInOurAccounts_menu')->default(0);
            $table->boolean('myPoints_menu')->default(0);
            $table->boolean('ticketOpen_menu')->default(0);
            $table->boolean('contact_us')->default(0);
            $table->boolean('points')->default(0);
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
        Schema::dropIfExists('users_settings');
    }
}
