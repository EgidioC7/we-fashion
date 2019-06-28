<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->name(),
        'description' => $faker->paragraph(),
        'price' => $faker->randomFloat(2,1,100),
        'reference' => $faker->regexify('[A-Za-z0-9]{16}'),
        'status_publish' => $faker->boolean(50),
        'status_product' => $faker->randomElement(['sold', 'standard']),
    ];
});
