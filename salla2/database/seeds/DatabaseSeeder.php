<?php

use App\Models\Category;
use App\Models\Language;
use App\Models\product\stores;
use App\Models\Product_type;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsTableSeeder::class);
        factory(\App\User::class,20)->create();
         factory(\App\Message::class,200)->create();
         factory(\App\membership::class,20)->create();
         factory(\App\Models\Language::class,2)->create();
         factory(\App\Models\product\stores::class,5)->create();
         factory(\App\Models\product_type::class,5)->create();
         factory(\App\Models\Category::class,5)->create();
         $this->call(CountriesTableSeeder::class);
         $this->call(CitiesTableSeeder::class);
//         $this->call(RoleSeeder::class);
//         $this->call(PermissionsTableSeeder::class);
    }
}
