<?php

use Faker\Generator as Faker;
use App\BlogPost;
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

$factory->define(App\BlogPost::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'author' => $faker->name,
        'author_id' => 1,
        'desc' => $faker->name,
        'content' => $faker->name,
        'image_url' => 1,
        'comment_count' => 2,
        'access' => $faker->name
    ];
});
