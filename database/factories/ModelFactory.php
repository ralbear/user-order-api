<?php

use App\Models\User;
use App\Models\Order;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$DKM5h/dyinG6F1bPKNlCw.tTYaf9F.x6sgHFoFY77xTz4lKrJsnjW',
        'remember_token' => str_random(10),
    ];
});

$factory->define(Order::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'user_id' => $faker->name,
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'status' => $faker->randomElement($array = array ('draft','accepted','delivered')),
        'amount' => $faker->numberBetween(000, 99999)
    ];
});
