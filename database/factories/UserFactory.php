<?php

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

$factory->define(Solsticio\User::class, function (Faker $faker) {
    $number1 = $faker->numberBetween($min = 1, $max = 12);
    $number2 = $faker->numberBetween($min = 1, $max = 4);
    return [
        'role' => $faker->randomElement(['PROPIETARIO', 'ARRENDATARIO']),
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'torre' => $faker->numberBetween($min = 1, $max = 12),
        'apartamento' => $number1.'0'.$number2,
        'profile_img' => $faker->imageUrl($width = 500, $height = 500),
        'status' => $faker->randomElement(['PENDING', 'APPROVED']),
        'remember_token' => str_random(10),
    ];
});
