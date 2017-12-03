<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\AddProductToCartRequest;
use App\Models\PriceType;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{

	/**
	 * @return string
	 */
	private function getHtmlEmptyCart(){
		return $html = '<p>Корзина удалена</p>
					 <a href="'.route('store').'" class="btn btn-primary">В магазин</a>';
	}

    /**
     * @param AddProductToCartRequest $request
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
	public function addToCart(AddProductToCartRequest $request,Product $product, PriceType $priceType){

		if(!Auth::check()){
			return $this->jsonResponse(['message' => 'Error user data']);//user error
		}

		$getProduct = $product->find($request->productId);
        $getAllPriceTypes = $priceType->get();

		$price_type = $getAllPriceTypes[Auth::user()->price_type]['type']??'price_user';

		Cart::restore(Auth::user()->id);
		Cart::add($getProduct->sku, $getProduct->name, $request->qty, $getProduct->$price_type);
		Cart::store(Auth::user()->id);

		return $this->jsonResponse($getProduct);//Todo set return data
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function deleteCart(Request $request){

		Cart::restore(Auth::user()->id);
		$request->session()->forget('cart');
		if(!$request->session()->has('cart')){
			return $this->jsonResponse(['html' => $this->getHtmlEmptyCart()]);
		}
		return $this->jsonResponse(['html'=>$this->getHtmlEmptyCart()]);
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function deleteCartItem(Request $request){

		Cart::restore(Auth::user()->id);
		Cart::remove($request->rowId);
		Cart::store(Auth::user()->id);

		if(Cart::count() > 0){
			return $this->jsonResponse([
				'deleteId'=>$request->rowId,
				'total'=>Cart::total(),
			]);
		}

		return $this->jsonResponse(['html'=>$this->getHtmlEmptyCart()]);
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function setCartItemAmount(Request $request){

		Cart::restore(Auth::user()->id);
		Cart::update($request->rowId, $request->amount);
		Cart::store(Auth::user()->id);

		if(Cart::count() > 0 && Cart::get($request->rowId)){
			return $this->jsonResponse([
				'item'=>Cart::get($request->rowId),
				'total'=>Cart::total(),
			]);
		}
	}

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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
            'cart' => $request->session()->get('cart'),
            'user'=>Auth::user(),
            'totalSum'=>Cart::total()
        ]);
    }

}
