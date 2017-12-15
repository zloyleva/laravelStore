<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\User;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'status', 'address', 'phone', 'total', 'note'
    ];

    public function orderListItems()
    {
        return $this->hasMany(OrderList::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function listOrdersForUser()
    {
        return $this->where('user_id', '=', Auth::user()->id)->get();
    }

    /**
     * Create new Order
     */
    public function createOrder($request, $userId)
    {

        Cart::restore($userId);
        $itemsList = Cart::content();

        $orderInstance = Order::create([
            'user_id' => $userId,
            'status' => 'pending',
            'phone' => $request->phone,
            'address' => $request->address,
            'total' => filter_var(Cart::total(), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'note' => $request->note
        ]);

        Cart::destroy();
        return [
            'order_id' => $orderInstance->id,
            'orderList' => $itemsList,
            'orderInstance' => $orderInstance,
        ];
    }

    public function showOrdersAdmin()
    {
        return $this->with('user')->paginate(20);
    }

    public function listOrderDataForUser($request)
    {
        return $this->with('orderListItems')->where('id', '=', $request->id)->first();
    }

    /**
     * @param $user
     * @param $result
     */
    public function createOrderFile(User $user, $result){
        $jsonOrder = [
            'user'=>[
                'name'=>$user->getName(),
                'email'=>$user->getEmail(),
                'dalivery'=>$result['orderInstance']['address'],
                'phone'=>$result['orderInstance']['phone'],
                'note'=>$result['orderInstance']['note'],
                'total'=>$result['orderInstance']['total'],
                'date'=>$result['orderInstance']['created_at']->toDateTimeString(),
            ],
            'products'=>[]
        ];

        foreach ($result['orderList'] as $product){
            $jsonOrder['products'][] = [
                'sku'=>$product->id,
                'name'=>$product->name,
                'qty'=>$product->qty,
                'price'=>$product->price,
                'total'=>$product->total,
            ];
        }

        $dataToJson = json_encode($jsonOrder);
        $orderFileName = $result['orderInstance']['id'].'_order.json';

        // todo add queue for create files
        try{
            Storage::disk('orders_dir')->put($orderFileName, $dataToJson);

            Storage::disk('ftp')->put('/orders/old/'.$orderFileName, $dataToJson);
        }catch (\Exception $e){

        }

    }
}
