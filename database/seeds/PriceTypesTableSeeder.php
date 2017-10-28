<?php

use Illuminate\Database\Seeder;
use App\Models\PriceType;

class PriceTypesTableSeeder extends Seeder
{
    protected $dataList = [
        'price_user' => 'Розничная',
        'price_3_opt' => 'Оптовая #3',
        'price_8_opt' => 'Оптовая #8',
        'price_dealer' => 'Диллерская',
        'price_vip' => 'VIP',
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

        foreach($this->dataList as $data => $description){
            PriceType::create([
                'type'=>$data,
	            'description'=>$description
            ]);
        }
    }
}
