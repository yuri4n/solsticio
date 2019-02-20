<?php

use Faker\Generator as Faker;

$factory->define(Solsticio\Category::class, function (Faker $faker) {
    $title = $faker->sentence(1);
    return [
        'name' => $title,
        'slug' => str_slug($title),
        'description' => $faker->text(500)
    ];
});
