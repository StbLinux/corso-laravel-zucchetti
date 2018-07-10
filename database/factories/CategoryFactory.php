<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    $name = $faker->unique()->word;

    return [
        'name' => $name,
        'slug' => str_slug($name),
    ];
});
