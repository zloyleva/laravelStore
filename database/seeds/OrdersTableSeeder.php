<?php

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;

class OrdersTableSeeder extends Seeder
{
    private $ordersStatus = [
      'pending','in progress','cancel','done'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Order::truncate();
      $faker = \Faker\Factory::create();
      $users = User::all()->toArray();

      for($i=1; $i < 3; $i++){
        Order::create([
          'user_id' => $faker->randomElement($users)['id'],
          'status' => $faker->randomElement($this->ordersStatus),
          'address' => $faker->address(),
          'phone' => $faker->tollFreePhoneNumber(),
          'total' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 2500),
          'note' => $faker->text($maxNbChars = 200),
        ]);
      }
    }
}
