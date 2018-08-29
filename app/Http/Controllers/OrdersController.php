<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderList;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\CreatedOrder;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;

class OrdersController extends Controller
{
	/**
	 * OrdersController constructor.
	 */
	public function __construct()
	{

	}

    /**
     * @param Request $request
     * @param Order $order
     * @param OrderList $orderList
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
	public function createOrder(Request $request, Order $order, OrderList $orderList, User $user){

        $currentUserId = $this->getIdsOfCurrentUser($request);
        $result = $order->createOrder($request,$currentUserId, $orderList);
        $request->session()->forget('cart');

        /**
         * todo need to move to own Class
         */
        $redirectUrl = route('store');
        if(Auth::check()){
            $sendTo = $user->find(Auth::user()->id);
            Mail::to($sendTo)->send(new CreatedOrder($result['order_id'], $order));

            $redirectUrl = route('orders.list');
        }

        $order->createOrderFile($currentUserId, $result, $user);

        Log::info("Order was create #{{$result['order_id']}}");

        $message = "Создан новый заказ №{$result['order_id']}.\n";
        $message .= "Телефон: {$result['orderInstance']['phone']}\n";
        $message .= "Адрес: {$result['orderInstance']['address']}\n";
        $message .= "Итого: {$result['orderInstance']['total']}\n";

        Telegram::sendMessage([
            'chat_id' => env('GROUP_ID2'),
            'text' => $message,
            'parse_mode'=>'HTML'
        ]);


        //to JS
        $jsonOrder = [];
        $transaction = [
            'id'=> $result['order_id'],                     // Transaction ID.
            'affiliation' => 'Dom Kanc',                    // Affiliation or store name.
            'revenue' => $result['orderInstance']['total'], // Grand Total.
        ];

        foreach ($result['orderList'] as $product){
            $jsonOrder[] = [
                'id' => $result['order_id'],
                'name' => $product->name,
                'sku' => $product->sku??$product->id,
                'category' => $product->category_id,
                'price' => $product->price,
                'quantity' => strval($product->qty),
            ];
        }

        //Redirect to THNX page + eCommerce stat
        return $this->jsonResponse([
            'result'=>$result,
            'message'=>'order Created',
            'redirectUrl'=>$redirectUrl,

            'transaction'=>$transaction,
            'jsonOrder'=>$jsonOrder,
        ]);
	}

    /**
     * @param $request
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    private function getIdsOfCurrentUser($request){
        if(!$currentUser = auth('api')->user()){
            $currentUser = $request->user_ids;
        }else{
            $currentUser = $currentUser->id;
        }
        return $currentUser;
    }


    /**
	 * @param Request $request
	 * @param Order $orders
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function listOrders(Request $request, Order $orders){

		return view('orders.list',[
			'orders'=>$orders->listOrdersForUser()
		]);
	}

    /**
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function showOrder(Request $request, Order $order){
        $data = $order->listOrderDataForUser($request);
        if( $data && (Auth::user()->id == $data->user_id || Auth::user()->role == 'admin') ){
            return view('orders.show',[
                'order' => $data
            ]);
        }
        return redirect('/');
    }

    /**
     * @param $id
     * @param Order $order
     * @param OrderList $list
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function print($id, Order $order, OrderList $list, User $user){

        $currentOrder = $order->where('id', $id)->first();
        $currentList = $list->where('order_id', $id)->get();
        $result = [
            'order_id' => $currentOrder->id,
            'orderList' => $currentList,
            'orderInstance' => $currentOrder,
        ];
        $orderOwner = $user->where('id', $currentOrder->user_id)->first();
        $order->createOrderFile($orderOwner, $result);

        return redirect()->route('admin.ordersList');
    }
}
