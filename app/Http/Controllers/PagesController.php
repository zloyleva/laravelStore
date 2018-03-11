<?php

namespace App\Http\Controllers;

use App\Models\ArrivalGoods;
use App\Models\PriceType;
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
    public function home(Category $category, Slider $slider){
        $collection = $collection1 = $category->collectCategories();
        $parent_id = 0;
        $categories = $category->categoryHandler($collection,$parent_id);


        return view('pages.home',[
            'categories'=>$categories,
            'sliders' => $slider->getAllPublishedSlides()
        ]);
    }

    public function myProfile(PriceType $price_type){
	    return view('store.my_profile', [
			    'pageName'=>'My profile',
			    'user'=>Auth::user(),
			    'price_type_desc'=>$price_type->where('id','=',Auth::user()->price_type)->first()
		    ]
	    );
    }

    public function load_price(ArrivalGoods $arrivalGoods, PriceType $priceType){

        $arrivals = $arrivalGoods->where('publish', '=', true)->get();

        $title = 'Розничная';
        $price_type = 'price_user';

        if(Auth::check()){
            $user_price_type = $priceType->where('id', Auth::user()->price_type)->first();
            $title = $user_price_type->description;
            $price_type = $user_price_type->type;
        }

        return view('pages.load_price', ['pageName'=>'Приходы товара', 'title'=>$title, 'price_type'=>$price_type, 'arrivals'=>$arrivals]);
    }

    public function contacts(){
        return view('pages.contacts');
    }

    public function site_map(Category $category){
        $collection = $collection1 = $category->collectCategories();
        $parent_id = 0;

        $categories = $category->categoryHandler($collection,$parent_id);
        return view('pages.site_map',[
            'pageName'=>'Карта сайта',
            'categories'=>$categories,
        ]);
    }

    public function after_registration(){
        return view('pages.after_registration',[
            'pageName'=>'Спасибо Вам за регистрацию!',
        ]);
    }
}
