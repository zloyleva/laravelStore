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

class OrdersController extends Controller
{
	/**
	 * OrdersController constructor.
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * @param Request $request
	 * @param Order $order
	 * @param OrderList $orderList
	 *
	 * @return \Illuminate\Http\JsonResponse|string
	 */
	public function createOrder(Request $request, Order $order, OrderList $orderList, User $user){

		if(Auth::check()){
			$result = $order->createOrder($request,Auth::user()->id);
			$request->session()->forget('cart');

			$orderList->createOrderList($result);

            /**
             * todo need to move to own Class
             */
            $sendTo = $user->find(2);
            Mail::to($sendTo)->send(new CreatedOrder($result['order_id'], $order));

            Log::info('send mail');

			return $this->jsonResponse([
				'result'=>$result,
				'message'=>'order Created',
				'redirectUrl'=>route('orders.list'),
			]);
		}
		return 'error to create Order';
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
}
