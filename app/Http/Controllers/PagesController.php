<?php

namespace App\Http\Controllers;

use App\Models\ArrivalGoods;
use App\Models\PriceType;
use App\Models\Sale;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

use App\Http\Requests\Product\ProductSearchRequest;

class PagesController extends Controller
{
    /**
     * @param Category $category
     * @param Slider $slider
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home(Category $category, Slider $slider){
        $collection = $collection1 = $category->collectCategories();
        $parent_id = 0;
        $categories = $category->categoryHandler($collection, $parent_id);


        return view('pages.home',[
            'categories'=>$categories,
            'sliders' => $slider->getAllPublishedSlides()
        ]);
    }

    /**
     * @param PriceType $price_type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myProfile(PriceType $price_type){
	    return view('store.my_profile', [
			    'pageName'=>'My profile',
			    'user'=>Auth::user(),
			    'price_type_desc'=>$price_type->where('id','=',Auth::user()->price_type)->first()
		    ]
	    );
    }

    /**
     * @param ArrivalGoods $arrivalGoods
     * @param PriceType $priceType
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function load_price(ArrivalGoods $arrivalGoods, PriceType $priceType){

        $arrivals = $arrivalGoods->where('publish', '=', true)->orderBy('created_at', 'desc')->get();

        $title = 'Розничная';
        $price_type = 'price_user';

        if(Auth::check()){
            $user_price_type = $priceType->where('id', Auth::user()->price_type)->first();
            $title = $user_price_type->description;
            $price_type = $user_price_type->type;
        }

        return view('pages.load_price', ['pageName'=>'Приходы товара', 'title'=>$title, 'price_type'=>$price_type, 'arrivals'=>$arrivals]);
    }

    /**
     * @param Sale $sale
     * @param PriceType $priceType
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sales_price(Sale $sale, PriceType $priceType){

        $sales = $sale->where('publish', '=', true)->orderBy('created_at', 'desc')->get();

        $title = 'Розничная';
        $price_type = 'price_user';

        if(Auth::check()){
            $user_price_type = $priceType->where('id', Auth::user()->price_type)->first();
            $title = $user_price_type->description;
            $price_type = $user_price_type->type;
        }

        return view('pages.sale_price', ['pageName'=>'Акции на товары', 'title'=>$title, 'price_type'=>$price_type, 'sales'=>$sales]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contacts(){
        return view('pages.contacts');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about_us(){
        return view('pages.about_us');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pay(){
        return view('pages.pay');
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function site_map(Category $category){
        $collection = $collection1 = $category->collectCategories();
        $parent_id = 0;

        $categories = $category->categoryHandler($collection,$parent_id);
        return view('pages.site_map',[
            'pageName'=>'Карта сайта',
            'categories'=>$categories,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function after_registration(){
        return view('pages.after_registration',[
            'pageName'=>'Спасибо Вам за регистрацию!',
        ]);
    }
}
