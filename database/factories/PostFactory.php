<?php

use Faker\Generator as Faker;

$factory->define(Solsticio\Post::class, function (Faker $faker) {
    $title = $faker->sentence(5);
    return [
        'user_id' => rand(1,30),
        'title' => $title,
        'slug' => str_slug($title),
        'excerpt' => $faker->text(150),
        'body' => $faker->text(500),
        'file' => $faker->imageUrl($width = 1200, $height = 720),
        'status' => $faker->randomElement(['DRAFT', 'PUBLISHED']),
    ];
});
