<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

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
}
