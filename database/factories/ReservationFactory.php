<?php

use Faker\Generator as Faker;

$factory->define(Solsticio\Reservation::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,30),
        'nombre_responsable' => $faker->name($gender = null),
        'type' => $faker->randomElement(['BBQ', 'SS', 'SJ']),
        'fecha_solicitada' => $faker->date(),
        'additional_info' => $faker->text(800),
        'status' => $faker->randomElement(['PENDING', 'APPROVED']),
    ];
});
