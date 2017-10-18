<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
	/**
	 * @param Request $request
	 * @param Product $product
	 *
	 * @return \Illuminate\Http\JsonResponse|null
	 */
	public function addToCart(Request $request,Product $product){

		if(!Auth::check()){
			return $this->jsonResponse(['message' => 'Error user data']);//user error
		}
		$request->productId;
		$getProduct = $product->find($request->productId);

		$price_type = Auth::user()->price_type??'price_user';

		Cart::restore(Auth::user()->id);
		Cart::add($getProduct->sku, $getProduct->name, $request->qty, $getProduct->$price_type);
		Cart::store(Auth::user()->id);

		return $this->jsonResponse($getProduct);//Todo set return data
	}

	public function deleteCart(Request $request){

		Cart::restore(Auth::user()->id);
		$request->session()->forget('cart');
		if(!$request->session()->has('cart')){
			$html = '<p>Cart is destroy</p>
					 <a href="'.route('store').'" class="btn btn-primary">To Shop</a>';
			return $this->jsonResponse(['message' => $html]);
		}
		return $this->jsonResponse(['message' => 'Error destroy']);
	}
}
