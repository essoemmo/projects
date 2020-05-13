<?php

use Illuminate\Database\Seeder;

class SettingTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Setting::create([
            'mantance' => 1,
        ]);
    }
}
