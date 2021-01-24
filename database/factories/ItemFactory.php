<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'code' => $faker->unique()->randomNumber,
        'barcode' => $faker->numberBetween($min=1, $max=100),
        'evaluation' => Str::random(5),
        'delivery_mode' => Str::random(5),
        'department_id' => $faker->numberBetween($min=1, $max=9),
        'category_id' => $faker->numberBetween($min=1, $max=9),
        'unit_id' => $faker->numberBetween($min=1, $max=4),
        'alert_quantity' => $faker->numberBetween($min=1, $max=9),
    ];
});



$factory->define(\App\ProductPricing::class, function (Faker $faker) {
    return [
        'markup' => $faker->numberBetween($min=1, $max=99),
        'final_cost' => $faker->randomFloat(2, 10, 200),
        'avg_cost' => $faker->randomFloat(2, 10, 200),
        'last_grn_cost' => $faker->randomFloat(2, 10, 200),
        'final_price' => $faker->randomFloat(2, 10, 200),
    ];
});
