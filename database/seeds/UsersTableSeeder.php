<?php

use Illuminate\Database\Seeder;
use App\Models\User;

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
        $faker = \Faker\Factory::create();
        $password = Hash::make('root');

        for ($i = 1; $i < 10; $i++) {
            try {
                User::create([
                    'user_name' => $faker->userName,
                    'email' => $faker->email,
                    'password' => $password,
                    'fname' => $faker->firstName,
                    'lname' => $faker->lastName,
                    'role' => 'user',
                    'price_type' => 'dealer',
                    'address' => $faker->streetAddress,
                    'town' => $faker->city,
                ]);
            }catch (Exception $e){

            }
        }

    }
}
