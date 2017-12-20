<?php

use Faker\Generator as Faker;
use App\Models\User;
use App\Models\Manager;
use App\Models\Order;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => 'Test',
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('123456'),
        'fname' => 'Unnamed',
        'lname' => 'Unnamed',
        'role' => 'user',
        'price_type' => 1,
        'address' => '',
        'manager_id' => 1,
    ];
});

$factory->define(Manager::class, function (Faker $faker) {
    return [
        'name' => 'Free',
        'email' => $faker->unique()->safeEmail,
    ];
});

$factory->define(Order::class, function (Faker $faker){
    return[
        'user_id' => $faker->numberBetween($min = 1, $max = 9),
        'status' => 'pending',
        'phone' => $faker->e164PhoneNumber,
        'address' => $faker->address,
        'total' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 10, $max = 10000),
        'note' => $faker->text($maxNbChars = 200)
    ];
});

