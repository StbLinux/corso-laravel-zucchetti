<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $title = $faker->sentence;

    return [
        'title' => $title,
        'slug' => str_slug($title),
        'preview' => $faker->paragraph,
        'body' => $faker->paragraphs(7, true),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'category_id' => function () {
            return factory(App\Category::class)->create()->id;
        },

        'created_at' => $faker->dateTimeBetween('-2 years'),
    ];
});
