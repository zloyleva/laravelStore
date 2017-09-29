<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class PagesController extends Controller
{
    public function home(){
        return view('welcome');
    }

    public function store(Product $product){
        return view('store.index',[
            'products'=>$product->listProducts()
        ]);
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
            'productsInCart'=>Cart::content(),
            'cart' => $request->session()->get('cart')
        ]);
    }

    public function showOrders(Request $request, Order $orders){

      if($request->status === 'setOrder' ){
        Cart::restore(Auth::user()->id);
        if(Cart::count() > 0){
          $orders->createOrder($request,Auth::user()->id);
          $request->session()->forget('cart');
        }        
      }

      $request->flashOnly(['status', 'note', 'phone']);
      return view('store.orders',[
          'orders'=>$orders->listOrdersForUser()
      ]);
    }
}
