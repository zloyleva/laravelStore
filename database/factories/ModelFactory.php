<?php

use Faker\Generator as Faker;

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name' => 'Test',
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('123456'),
        'fname' => 'Unnamed',
        'lname' => 'Unnamed',
        'role' => 'user',
        'price_type' => 1,
        'address' => '',
        'manager_id' => 1,
    ];
});

$factory->define(App\Models\Manager::class, function (Faker $faker) {
    return [
        'name' => 'Free',
        'email' => $faker->unique()->safeEmail,
    ];
});

