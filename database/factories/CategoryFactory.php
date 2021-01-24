<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'code' => $faker->unique()->randomNumber,
        'parent_category' => $faker->numberBetween(1, 10),
    ];
});
