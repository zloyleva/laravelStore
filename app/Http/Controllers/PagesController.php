<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

use App\Http\Requests\Product\ProductSearchRequest;

class PagesController extends Controller
{
    public function home(){
        return view('welcome');
    }

    public function showCard(Request $request){

        if(Auth::check()){
          $identifcator = Auth::user()->id;
        }else {
          $identifcator = '';
        }

        Cart::restore($identifcator);
        Cart::store($identifcator);

        return view('store.cart',[
        	'request'=>$request->session()->get('laravel_session'),
            'productsInCart'=>Cart::content(),
            'cart' => $request->session()->get('cart')
        ]);
    }

    public function showOrder(Request $request, Order $order){
      $data = $order->listOrderDataForUser($request);
      if( Auth::user()->id == $data->user_id ){
        return view('orders.show',[
            'order' => $data
        ]);
      }
      return redirect('/');
    }

    public function myProfile(){

    }
}
