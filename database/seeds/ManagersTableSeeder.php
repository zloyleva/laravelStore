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
        $managers = [
            ['name' => 'Free','email' => 'zloyleva@gmail.com'],
            ['name' => 'Минаева Анжела','email' => 'minaevaangela@gmail.com'],
        ];
        foreach ($managers as $manager){
            try{
                factory(Manager::class)->create($manager);
            }catch(Exception $e){
                print_r($manager);
            }
        }
    }
}
