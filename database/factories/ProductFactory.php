<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'slug' => $faker->slug,
        'subtitle' =>$faker->sentence(2),
        'description' => $faker->text,
        'price' => $faker->numberbetween(1000,10000),
        'image' => 'Http://via.placeholder.com/200x200',
    ];
});
