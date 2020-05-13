<?php

use App\Models\Category;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => Str::random(10),
        'guard' => 'store',
    ];
});
$factory->define(App\Message::class, function (Faker $faker) {
    return [
        'from' => 1,
        'to' => rand(1,19),
        'text' => $faker->sentence
    ];
});
$factory->define(App\membership::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence,
        'is_active'=>true,
        'price'=>rand(100,500),
        'duration'=>rand(1,3),
    ];
});
$factory->define(App\Models\Language::class, function (Faker $faker) {
    return [
        'title'=>'ar',
        'code'=>rand(1000,5000),
        'flag'=>$faker->image('public/uploads',400,300, null, false) ,
    ];
});
$factory->define(App\Models\product\stores::class, function (Faker $faker) {
    return [
        'title'=>$faker->name,
        'domain'=>$faker->url,
        'lang_id'=>rand(1,2),
        'owner_id'=>rand(1,5),
        'membership_id'=>rand(1,10),
    ];
});
$factory->define(App\Models\product_type::class, function (Faker $faker) {
    return [
        'title'=>$faker->name,
        'description'=>$faker->sentence,
        'store_id'=>rand(1,4),
    ];
});
$factory->define(App\Models\product\store_language::class, function (Faker $faker) {
    return [
        'store_id'=>rand(1,5),
        'language_id'=>rand(1,2),
    ];
});

$factory->define(App\Models\Category::class, function (Faker $faker) {
    return [
        'title'=>$faker->name,
        'description'=>$faker->sentence,
        'number'=>rand(1,5),
//        'store_id'=>rand(1,5),
//        'language_id'=>rand(1,2),
    ];
});
