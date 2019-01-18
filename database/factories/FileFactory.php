<?php

use Faker\Generator as Faker;

$factory->define(App\File::class, function (Faker $faker) {
    return [
        'description' => $faker->text(50),
        'file' => $faker->randomElement(['pdf-test.pdf', 'test.pdf', 'test2.pdf']),
    ];
});
