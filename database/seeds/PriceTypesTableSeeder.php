<?php

use Illuminate\Database\Seeder;
use App\Models\PriceType;

class PriceTypesTableSeeder extends Seeder
{
    protected $dataList = [
        'vip',
        'dealer',
        '3_opt',
        '8_opt',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        PriceType::truncate();
        $faker = \Faker\Factory::create();

        foreach($this->dataList as $data){
            PriceType::create([
                'type'=>$data
            ]);
        }
    }
}
