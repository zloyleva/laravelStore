<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PriceType;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::truncate();

        $faker = \Faker\Factory::create();
        $password = Hash::make('root');
        $priceTypeArray = PriceType::all()->toArray();

        for ($i = 1; $i < 10; $i++) {
            try {
                User::create([
                    'name' => $faker->userName,
                    'email' => $faker->email,
                    'password' => $password,
                    'fname' => $faker->firstName,
                    'lname' => $faker->lastName,
                    'role' => 'user',
                    'price_type' => $faker->randomElement($priceTypeArray)['type'],
                    'address' => $faker->streetAddress,
                    'town' => $faker->city,
                ]);
            }catch (Exception $e){

            }
        }

    }
}
