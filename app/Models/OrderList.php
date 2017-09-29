<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    protected $fillable = [
      'order_id','sku','name','qty','price', 'total'
    ];

    public function createOrderList($data){

      foreach ($data['orderList'] as $value) {
        $this->create([
          'order_id' => $data['order_id'],
          'sku' => $value->id,
          'name' => $value->name,
          'qty' => $value->qty,
          'price' => $value->price,
          'total' => $value->total,
        ]);
      }
    }

}
