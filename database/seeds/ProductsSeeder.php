<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Category;
use App\Product;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $categorys = Category::all()->pluck('id')->toArray();

        foreach(range(1,1000) as $index) {
            Product::create([
                'name' => $faker->word,
                'price' => $faker->randomFloat(2,1,1000),
                'stock'=> $faker->numberBetween(1,100),
                'category_id' => $faker->randomElement($categorys),
            ]);
        }
    }
}
