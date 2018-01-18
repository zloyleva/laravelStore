<?php

namespace App\Http\Controllers;

use App\Models\PriceType;
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
//        return view('welcome');
        //todo: new year redirect
        return redirect('store');
    }

    public function myProfile(PriceType $price_type){
	    return view('store.my_profile', [
			    'pageName'=>'My profile',
			    'user'=>Auth::user(),
			    'price_type_desc'=>$price_type->where('id','=',Auth::user()->price_type)->first()
		    ]
	    );
    }

    public function load_price(){

        $title = "Розничная";
        $link = "http://localhost/1";
        if(Auth::check()){
            switch (Auth::user()->price_type) {
                case 1:
                    $title = "Розничная";
                    $link = "";
                    break;
                case 2:
                    $title = "Оптовая #3";
                    $link = "";
                    break;
                case 3:
                    $title = "Оптовая #8";
                    $link = "";
                    break;
                case 4:
                    $title = "Диллерская";
                    $link = "";
                    break;
                case 5:
                    $title = "VIP";
                    $link = "";
                    break;
            }
        }

        return view('pages.load_price', ['title'=>$title, 'link'=>$link]);
    }

    public function contacts(){
        return view('pages.contacts');
    }
}
