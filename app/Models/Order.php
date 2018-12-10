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
     * @param $request
     * @param $userId
     * @param \App\Models\OrderList $orderList
     * @return array
     */
    public function createOrder($request, $userId, OrderList $orderList)
    {

        Cart::restore($userId);
        $itemsList = Cart::content();

        $orderInstance = Order::create([
            'user_id' => $userId,
            'status' => 'В ожидании',
            'phone' => $request->phone,
            'address' => $request->address,
            'total' => filter_var(Cart::total(), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'note' => $request->note
        ]);

        $orderList->createOrderList([
            'order_id' => $orderInstance->id,
            'orderList' => $itemsList,
            'orderInstance' => $orderInstance,
        ]);

        Cart::destroy();
        return [
            'order_id' => $orderInstance->id,
            'orderList' => $itemsList,
            'orderInstance' => $orderInstance,
        ];
    }

    /**
     * @return mixed
     */
    public function showOrdersAdmin()
    {
        return $this
            ->select(
            	'orders.id',
	            'orders.created_at',
	            'users.email',
	            'users.name',
	            'users.fname',
	            'users.lname',
	            'orders.phone',
	            'users.company',
	            'orders.address',
	            'orders.status',
	            'orders.total',
	            'managers.name as manager',
	            'users.price_type',
	            'price_types.description'
            )
            ->leftJoin('users', 'user_id', '=', 'users.id')
            ->leftJoin('managers', 'users.manager_id', '=', 'managers.id')
            ->leftJoin('price_types', 'users.price_type', '=', 'price_types.id')
            ->latest()
            ->paginate(20);
    }

    /**
     * @param $request
     * @return Order|\Illuminate\Database\Eloquent\Builder|Model|null|object
     */
    public function listOrderDataForUser($request)
    {
        return $this->with('orderListItems')->where('id', '=', $request->id)->first();
    }

    /**
     * @param $user
     * @param $result
     */
    public function createOrderFile($currentUserId, $result, $user=null){

        if($user && ($findUser = $user->where('id', $currentUserId)->first() ) ){
            $userName = $findUser->getName();
            $userEmail = $findUser->getEmail();
        }

        $jsonOrder = [
            'user'=>[
                'name' => $userName ?? "Неуказанно",
                'email'=> $userEmail ?? "Неуказанно",
                'dalivery' => $result['orderInstance']['address'],
                'phone' => $result['orderInstance']['phone'],
                'note' => $result['orderInstance']['note'],
                'total' => strval($result['orderInstance']['total']),
                'date' => $result['orderInstance']['created_at']->toDateTimeString(),
            ],
            'products'=>[]
        ];

        foreach ($result['orderList'] as $product){
            $jsonOrder['products'][] = [
                'sku'=>$product->sku??$product->id,
                'name'=>$product->name,
                'qty'=>strval($product->qty),
                'price'=>$product->price,
                'total'=>$product->total,
            ];
        }

        $dataToJson = json_encode($jsonOrder, JSON_UNESCAPED_UNICODE);
        $orderFileName = $result['orderInstance']['id'].'_order.json';

        // todo add queue for create files
        try{
            Storage::disk('orders_dir')->put($orderFileName, $dataToJson);

            Storage::disk('ftp')->put('/orders/'.$orderFileName, $dataToJson);
        }catch (\Exception $e){

        }

    }
}
