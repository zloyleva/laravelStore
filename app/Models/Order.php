<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\OrderList;

class Order extends Model
{
    protected $fillable = [
      'user_id','status','phone','total','note'
    ];

    public function listOrdersForUser(){
      return $this->where('user_id','=',Auth::user()->id)->get();
    }

    public function createOrder($request,$userId){
      Cart::restore($userId);
      $itemsList = Cart::content();

      $orderInstance = Order::create([
        'user_id' => $userId,
        'status'  =>  'pending',
        'phone' =>  $request->phone,
        'total' => filter_var(Cart::total(), FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION),
        'note'  => $request->note
      ]);

      Cart::destroy();
      return $orderInstance;
    }
}
