<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('points')->insert([
            [
                'points_number' => '20',
                'code' => 'reg',
            ],[
                'points_number' => '50',
                'code' => 'famous',
            ],[
                'points_number' => '30',
                'code' => 'ourAccounts',
            ],[
                'points_number' => '40',
                'code' => 'website',
            ],[
                'points_number' => '10',
                'code' => 'addAccount',
            ],
        ]);

        DB::table('points_translations')->insert([
            [
                'point_id' => '1',
                'title' => 'اكمال التسجيل',
                'description' => 'للحصول علي النقاط يجب اكمال التسجيل',
                'locale' => 'ar',
            ],[
                'point_id' => '1',
                'title' => 'registration completion',
                'description' => 'to get points complete register',
                'locale' => 'en',
            ],[
                'point_id' => '2',
                'title' => 'عمل اعلان مع المشاهير',
                'description' => 'عمل اعلان مع المشاهير',
                'locale' => 'ar',
            ],[
                'point_id' => '2',
                'title' => 'ad with celebrity',
                'description' => 'ad with celebrity',
                'locale' => 'en',
            ],[
                'point_id' => '3',
                'title' => 'اعلان مميز',
                'description' => 'اعلان مميز',
                'locale' => 'ar',
            ],[
                'point_id' => '3',
                'title' => 'featured ad',
                'description' => 'featured ad',
                'locale' => 'en',
            ],[
                'point_id' => '4',
                'title' => 'اعلان ع حساباتنا',
                'description' => 'اعلان ع حساباتنا',
                'locale' => 'ar',
            ],[
                'point_id' => '4',
                'title' => 'ad on our accounts',
                'description' => 'ad on our accounts',
                'locale' => 'en',
            ],[
                'point_id' => '5',
                'title' => 'اضافة حساب',
                'description' => 'اضافة حساب',
                'locale' => 'ar',
            ],[
                'point_id' => '5',
                'title' => 'add account',
                'description' => 'add account',
                'locale' => 'en',
            ],
        ]);
    }
}
