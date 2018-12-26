<?php

use Faker\Generator as Faker;

$factory->define(App\File::class, function (Faker $faker) {
    return [
        'description' => $faker->text(50),
        'file' => $faker->imageUrl($width=800, $height=600)
    ];
});
