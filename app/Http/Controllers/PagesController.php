<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use \Cart;

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

    public function showCard(){

        if(Auth::check()){
          $identifcator = Auth::user()->id;
        }else {
          $identifcator = '';
        }
        Cart::restore($identifcator);
        Cart::store($identifcator);

        return view('store.cart',[
            'productsInCart'=>Cart::content()
        ]);
    }
}
