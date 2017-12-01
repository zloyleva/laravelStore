<?php

use Illuminate\Database\Seeder;
use App\Models\Manager;

class ManagersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Manager::truncate();
        Manager::create([
            'name' => 'Free',
            'email' => 'zloyleva@gmail.com',
        ]);
    }
}
