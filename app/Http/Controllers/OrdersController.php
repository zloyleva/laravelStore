<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderList;
use Gloudemans\Shoppingcart\Facades\Cart;

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
	 * Create order from cart items
	 * @param Request $request
	 * @param Order $order
	 *
	 * @return string
	 */
	public function createOrder(Request $request, Order $order){
		if(Auth::check()){
			$orderId = $order->createOrder($request,Auth::user()->id);
			return $orderId;
		}
		return 'error to create Order';
	}

	/**
	 * @param Request $request
	 * @param Order $orders
	 * @param OrderList $orderList
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function listOrders(Request $request, Order $orders, OrderList $orderList){

		if($request->status === 'setOrder' ){
			Cart::restore(Auth::user()->id);
			if(Cart::count() > 0){
				$result = $orders->createOrder($request,Auth::user()->id);
				$request->session()->forget('cart');

				$orderList->createOrderList($result);
			}
		}

		$request->flashOnly(['status', 'note', 'phone']);
		return view('orders.list',[
			'orders'=>$orders->listOrdersForUser()
		]);
	}
}
