<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(15),
        'slug' => $faker->slug,
        'subtitle' =>$faker->sentence(10),
        'description' => $faker->text,
        'price' => $faker->numberbetween(15,300),
        'image' => 'Http://via.placeholder.com/200x200',
    ];
});
