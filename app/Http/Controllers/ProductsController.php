<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use \Cart;

class ProductsController extends Controller
{
    //
    public function addToCart(Request $request,Product $product){

        $request->productId;
        $getProduct = $product->find($request->productId);

        $price_type = 'price_user';
        if(Auth::check()){
            $price_type = Auth::user()->price_type;
        }
        Cart::restore(Auth::user()->id);
        Cart::add($getProduct->sku, $getProduct->name, $request->qty, $getProduct->$price_type);
        Cart::store(Auth::user()->id);

        return $this->jsonResponse(Auth::user());
    }
}
