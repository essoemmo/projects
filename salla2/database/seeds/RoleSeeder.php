<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name'=>'admin',
                'guard_name'=>'admin'
            ],
            [
                'name'=>'store',
                'guard_name'=>'store'
            ],
            [
                'name'=>'web',
                'guard_name'=>'web'
            ]
            ]);
    }
}
