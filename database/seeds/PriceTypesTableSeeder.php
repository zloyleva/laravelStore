<?php

use Illuminate\Database\Seeder;
use App\Models\PriceType;

class PriceTypesTableSeeder extends Seeder
{
    protected $dataList = [
        'price_user',
        'price_3_opt',
        'price_8_opt',
        'price_dealer',
        'price_vip',
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
