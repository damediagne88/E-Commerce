<?php

use Illuminate\Database\Seeder;
use App\Product;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i < 30; $i++) {
            Product::create([
                'title' => $faker->sentence(3),
                 'slug' => $faker->slug,
                 'subtitle' =>$faker->sentence(2),
                'description' => $faker->text,
                'price' => $faker->numberbetween(1000,10000),
                'image' => 'Http://via.placeholder.com/200x200'
                ])->categories()->attach([
                rand(1,4),
                rand(1,4)
            ]);
        }
    }
}
