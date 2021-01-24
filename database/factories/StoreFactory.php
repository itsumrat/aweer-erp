<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Store;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Store::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->phoneNumber,
        'code' => $faker->unique(true)->randomNumber,
        'email' => $faker->unique(true)->safeEmail,
        'address' => Str::random(10),
    ];
});
