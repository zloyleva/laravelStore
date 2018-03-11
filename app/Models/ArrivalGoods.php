<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArrivalGoods extends Model
{
    protected $fillable = [
        'price_user', 'price_3_opt', 'price_8_opt', 'price_dealer', 'price_vip', 'arrival_date', 'publish'
    ];

    public function addNewArrival($data){
        return ArrivalGoods::create([
            'price_user' => $data['price_user'],
            'price_3_opt' => $data['price_3_opt'],
            'price_8_opt' => $data['price_8_opt'],
            'price_dealer' => $data['price_dealer'],
            'price_vip' => $data['price_vip'],
            'arrival_date' => $data['arrival_date'],
            'publish' => $data['publish'] ?? true,
        ]);
    }

    public function updateArrival($data){
        $arrival = $this->where('id', $data['id'])->firstOrFail();

        $args = [
            'price_user' => $data['price_user'],
            'price_3_opt' => $data['price_3_opt'],
            'price_8_opt' => $data['price_8_opt'],
            'price_dealer' => $data['price_dealer'],
            'price_vip' => $data['price_vip'],
            'arrival_date' => $data['arrival_date'],
            'publish' => $data['publish'] ?? false,
        ];


        $arrival->fill($args);

        return $arrival->save();
    }
}
