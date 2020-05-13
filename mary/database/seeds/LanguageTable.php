<?php

use Illuminate\Database\Seeder;

class LanguageTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lang = ['ar', 'en','fr','po'];
        foreach ($lang as $key => $lg) {
            \App\Models\Language::create([
                'name' => $lg,
            ]);
        }
    }
}