<?php

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'title' 	=> $faker->sentence,
        'content' 	=> $faker->text,
        'user_id'	=> factory(App\User::class)
    ];
});