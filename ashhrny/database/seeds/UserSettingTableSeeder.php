<?php

use Illuminate\Database\Seeder;

class UserSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_settings')->insert([
            [
                'send_email' => '1',
                'send_sms' => '1',
                'send_section' => '1',
                'normal_user_register' => '1',
                'famous_user_register' => '1',
                'register_section' => '1',
                'famous_section' => '1',
                'famous_ads_menu' => '1',
                'famous_ads_front' => '1',
                'identification_number' => '1',
                'identification_image' => '1',
                'myAccounts_menu' => '1',
                'myAds_menu' => '1',
                'featuredAd_menu' => '1',
                'AdInOurAccounts_menu' => '1',
                'myPoints_menu' => '1',
                'ticketOpen_menu' => '1',
                'contact_us' => '1',
                'points' => '1',
            ]
        ]);
    }
}
