<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,50) as $index) {
            Category::create([
                'name' => $faker->word
            ]);
        }
    }
}
