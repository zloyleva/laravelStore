<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'price_user', 'price_3_opt', 'price_8_opt', 'price_dealer', 'price_vip', 'sales_date', 'publish'
    ];

    /**
     * @param array $data
     * @return Sale
     */
    public function addNewSale(array $data): Sale{
        return Sale::create([
            'price_user' => $data['price_user'],
            'price_3_opt' => $data['price_3_opt'],
            'price_8_opt' => $data['price_8_opt'],
            'price_dealer' => $data['price_dealer'],
            'price_vip' => $data['price_vip'],
            'sales_date' => $data['sales_date'],
            'publish' => $data['publish'] ?? false,
        ]);
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function updateSale(int $id, array $data){
        $arrival = $this->where('id', $id)->first();

        if(!$arrival){
            throw new \Exception("Can't find current sale");
        }

        $args = [
            'price_user' => $data['price_user'],
            'price_3_opt' => $data['price_3_opt'],
            'price_8_opt' => $data['price_8_opt'],
            'price_dealer' => $data['price_dealer'],
            'price_vip' => $data['price_vip'],
            'sales_date' => $data['sales_date'],
            'publish' => $data['publish'] ?? false,
        ];


        $arrival->fill($args);

        return $arrival->save();
    }
}
