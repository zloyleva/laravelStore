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
        if(Auth::check()){
            $sendTo = $user->find(Auth::user()->id);
            Mail::to($sendTo)->send(new CreatedOrder($result['order_id'], $order));
        }

        Log::info('send mail');

        $order->createOrderFile($currentUserId, $result, $user);

        return $this->jsonResponse([
            'result'=>$result,
            'message'=>'order Created',
            'redirectUrl'=>route('orders.list'),
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
