<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\OrderList;
use Illuminate\Http\Request;

class Order extends Model
{
    protected $fillable = [
      'user_id','status','address','phone','total','note'
    ];

    public function orderListItems(){
      return $this->hasMany(OrderList::class);
    }

    public function listOrdersForUser(){
      return $this->where('user_id','=',Auth::user()->id)->get();
    }

    /**
    * Create new Order
    */
    public function createOrder($request,$userId){

      Cart::restore($userId);
      $itemsList = Cart::content();

      $orderInstance = Order::create([
        'user_id' => $userId,
        'status'  =>  'pending',
        'phone' =>  $request->phone,
        'address' =>  $request->address,
        'total' => filter_var(Cart::total(), FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION),
        'note'  => $request->note
      ]);

      Cart::destroy();
      return [
        'order_id' => $orderInstance->id,
        'orderList' => $itemsList
      ];
    }

    public function listOrderDataForUser($request){
      return $this->with('orderListItems')->where('id', '=', $request->id)->first();
    }
}
