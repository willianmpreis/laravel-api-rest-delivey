<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Client;
use App\Product;
use App\Shopping;
use App\ShoppingCart;

class ShoppingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $clients = Client::all()->pluck('id')->toArray();
        $products = Product::all();

        foreach(range(1,100) as $index) {
            $shopping = Shopping::create([
                'client_id' => $faker->randomElement($clients),
                'date' => $faker->dateTimeThisYear('now')                
            ]);
            foreach(range(1, $faker->numberBetween(1,10)) as $i) {                
                $product = $faker->randomElement($products);
                $quantity = $faker->numberBetween(1,5);

                ShoppingCart::create([
                    'shopping_id' => $shopping->id,                    
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unitary' => $product->price,
                    'amount' => $product->price * $quantity,
                ]);
            }
        }        
    }
}
