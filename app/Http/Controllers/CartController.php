<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\AddProductToCartRequest;
use App\Models\PriceType;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

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
     * @param PriceType $priceType
     * @return \Illuminate\Http\JsonResponse
     */
	public function addToCart(AddProductToCartRequest $request,Product $product, PriceType $priceType){

		$currentUser = $this->getIdsOfCurrentUser($request);
		$getProduct = $product->find($request->productId);
        $price_type = $this->getPriceTypeOfCurrentUser($priceType);

		Cart::restore($currentUser);
		Cart::add($getProduct->sku, $getProduct->name, $request->qty, $getProduct->$price_type);
		Cart::store($currentUser);

		return $this->jsonResponse($getProduct);//Todo set return data
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function deleteCart(Request $request){

        $currentUser = $this->getIdsOfCurrentUser($request);

        Cart::restore($currentUser);
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

        $currentUser = $this->getIdsOfCurrentUser($request);

        Cart::restore($currentUser);
		Cart::remove($request->rowId);
		Cart::store($currentUser);

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

        $currentUser = $this->getIdsOfCurrentUser($request);

		Cart::restore($currentUser);
		Cart::update($request->rowId, $request->amount);
		Cart::store($currentUser);

		if(Cart::count() > 0 && Cart::get($request->rowId)){
			return $this->jsonResponse([
				'item'=>Cart::get($request->rowId),
				'total'=>preg_replace('/,/', '', Cart::total()),
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
            $identifcator = $request->cookie('user_ids');
        }

        $stored = DB::table('shoppingcart')->where('identifier', $identifcator)->first();
        $productsInCart = $stored?unserialize($stored->content):collect([]);

        return view('store.cart',[
            'request'=>$request->session()->get('laravel_session'),
            'productsInCart'=>$productsInCart,
            'cart' => $request->session()->get('cart'),
            'user'=>Auth::user(),
            'totalSum'=>preg_replace('/,/', '', $this->total($productsInCart))
        ]);
    }

    /**
     * @param $content
     * @return mixed
     */
    private function total($content)
    {
        $total = $content->reduce(function ($total, $cartItem) {
            return $total + ($cartItem->qty * $cartItem->priceTax);
        }, 0);

        return $total;
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
     * @param $priceType
     * @return string
     */
    private function getPriceTypeOfCurrentUser($priceType){
        if(!$currentUser = auth('api')->user()){
            $price_type = 'price_user';
        }else{
            $getAllPriceTypes = $priceType->get();
            $price_type = $getAllPriceTypes[$currentUser->price_type-1]['type']??'price_user';
        }
        return $price_type;
    }
}
