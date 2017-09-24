<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
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

        Cart::add('12345', 'Product 1 has long name too long, well very long', 1, 10.00);
        Cart::add('21345', 'Product 2', 1, 5.40);

        return view('store.card',[
            'productsInCart'=>Cart::content()
        ]);
    }
}
