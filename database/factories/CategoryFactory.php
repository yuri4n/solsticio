<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    $title = $faker->sentence(2);
    return [
        'name' => $title,
        'slug' => str_slug($title),
        'description' => $faker->text(500)
    ];
});
