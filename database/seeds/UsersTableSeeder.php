<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PriceType;

class UsersTableSeeder extends Seeder
{
    protected $userRoles = [
        'user',
	    'buyer',
    ];
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
        $password = Hash::make('0992550572oleh');
        $priceTypeArray = PriceType::all()->toArray();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => $password,
            'fname' => $faker->firstName,
            'lname' => $faker->lastName,
            'role' => 'admin',
            'price_type' => $faker->randomElement($priceTypeArray)['type'],
            'address' => $faker->streetAddress,
        ]);

        User::create([
            'name' => 'userName',
            'email' => 'zloyleva@gmail.com',
            'password' => $password,
            'fname' => $faker->firstName,
            'lname' => $faker->lastName,
            'role' => 'buyer',
            'price_type' => $faker->randomElement($priceTypeArray)['type'],
            'address' => $faker->streetAddress,
        ]);

    }
}
