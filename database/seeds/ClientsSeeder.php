<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Client;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('pt_BR');
        foreach(range(1,1000) as $index) {
            $cpf = str_pad($faker->randomNumber(3), 3, '0', STR_PAD_LEFT) . '.' . 
                   str_pad($faker->randomNumber(3), 3, '0', STR_PAD_LEFT) . '.' .
                   str_pad($faker->randomNumber(3), 3, '0', STR_PAD_LEFT) . '-' .
                   str_pad($faker->randomNumber(2), 2, '0', STR_PAD_LEFT);

            Client::create([
                'name' => $faker->name,
                'cpf' => $cpf,
                'phone'=> $faker->e164PhoneNumber,
                'birth'=> $faker->date('Y-m-d', $faker->dateTimeThisDecade('now')),
                'address'=> $faker->address
            ]);
        }        
    }
}
