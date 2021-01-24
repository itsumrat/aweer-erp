<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Vendor;
use Faker\Generator as Faker;

$factory->define(Vendor::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'code' => $faker->unique()->randomNumber,
        'company' => $faker->name,
        'email' => $faker->unique()->safeEmail,

        'vat_no' => $faker->randomNumber,
        'city' => $faker->city,
        'phone' => $faker->phoneNumber,
        'country' => $faker->country,
        'payment_term' => $faker->numberBetween($min=1, $max=31),
    ];
});
