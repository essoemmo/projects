<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            [
                'title' => 'مصر',
                'code' => '0020',
                'logo' => 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg',
                'lang_id'=>1
            ],[
                'title' => 'السعودية',
                'code' => '‎00966',
                'logo' => 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg',
                'lang_id'=>1
            ],[
                'title' => 'العراق',
                'code' => '00964',
                'logo' => 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg',
                'lang_id'=>1
            ],[
                'title' => 'سوريا',
                'code' => '‎00963',
                'logo' => 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg',
                'lang_id'=>1
            ],[
                'title' => 'لبنان',
                'code' => '00961',
                'logo' => 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg',
                'lang_id'=>1
            ],[
                'title' => 'الاردن',
                'code' => '00962',
                'logo' => 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg',
                'lang_id'=>1
            ],[
                'title' => 'اليمن',
                'code' => '00967',
                'logo' => 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg',
                'lang_id'=>1
            ],[
                'title' => 'ليبيا',
                'code' => '00218',
                'logo' => 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg',
                'lang_id'=>1
            ],[
                'title' => 'المغرب',
                'code' => '00212',
                'logo' => 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg',
                'lang_id'=>1
            ],[
                'title' => 'تونس',
                'code' => '00216',
                'logo' => 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg',
                'lang_id'=>1
            ],[
                'title' => 'الكويت',
                'code' => '00965',
                'logo' => 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg',
                'lang_id'=>1
            ],[
                'title' => 'الجزائر',
                'code' => '‎00966',
                'logo' => 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg',
                'lang_id'=>1
            ],[
                'title' => 'البحرين',
                'code' => '00973',
                'logo' => 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg',
                'lang_id'=>1
            ],[
                'title' => 'قطر',
                'code' => '00974',
                'logo' => 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg',
                'lang_id'=>1
            ],[
                'title' => 'الإمارات العربية المتحدة',
                'code' => '00971',
                'logo' => 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg',
                'lang_id'=>1
            ],[
                'title' => 'سلطنة عمان',
                'code' => '00968',
                'logo' => 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg',
                'lang_id'=>1
            ],

        ]);
    }
}
