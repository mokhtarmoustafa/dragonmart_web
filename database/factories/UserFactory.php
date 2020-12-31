<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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
//`username`, `email`, `email_verified_at`, `password`, `mobile`, `verification_code`, `is_confirm`,
// `address`, `latitude`, `longitude`, `image`, `type`, `is_active`
$factory->define(User::class, function (Faker $faker) {
    return [
        'username' => $faker->userName,
        'mobile' => $faker->phoneNumber,
        'address' => $faker->address,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'image' => $faker->imageUrl(),
        'verification_code' => '111111',
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'is_confirm_code' => 1,
        'is_active' => 1,
        'type' => 'driver',
        'city_id' => 3,
        'password' => bcrypt('123456'), //
        'remember_token' => Str::random(10),
    ];
});

//`name`, `username`, `email`, `password`, `mobile`, `logo`, `type`, `status`

$factory->define(\App\Admin::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->userName,
        'mobile' => $faker->phoneNumber,
        'logo' => $faker->imageUrl(),
        'email' => $faker->unique()->safeEmail,
        'type' => 'merchant',
        'status' => 1,
        'password' => bcrypt('123456'), //
        'remember_token' => Str::random(10),
    ];
});

// `merchant_id`, `name`,

$factory->define(\App\Store::class, function (Faker $faker) {
    return [
        'name' => $faker->userName,
        'merchant_id' => 21,
    ];
});

//  `store_id`, `category_id`

$factory->define(\App\StoreCategory::class, function (Faker $faker) {
    return [
        'store_id' => 2,
        'category_id' => 11,
    ];
});

//  `store_id`, `driver_id`

$factory->define(\App\StoreDriver::class, function (Faker $faker) {
    return [
        'store_id' => 2,
        'driver_id' => 1,
    ];
});