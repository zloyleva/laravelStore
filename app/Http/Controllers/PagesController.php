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
        $link = "https://drive.google.com/file/d/1eLJn9gyqMXpCUPSUZ2kHXvn6KOjEqMeE/view";
        if(Auth::check()){
            switch (Auth::user()->price_type) {
                case 1:
                    $title = "Розничная";
                    $link = "https://drive.google.com/file/d/1eLJn9gyqMXpCUPSUZ2kHXvn6KOjEqMeE/view";
                    break;
                case 2:
                    $title = "Оптовая #3";
                    $link = "https://drive.google.com/file/d/1BVPwl71lTGVH3mBQpz1XQLv1sjRparbH/view";
                    break;
                case 3:
                    $title = "Оптовая #8";
                    $link = "https://drive.google.com/file/d/1HDjzEaJ2EaOuejUhI0BGtni1xFHmWUyf/view";
                    break;
                case 4:
                    $title = "Диллерская";
                    $link = "https://drive.google.com/file/d/1XZ6ERlKPx8r7B7G4FGQOu_BkCGCshiII/view";
                    break;
                case 5:
                    $title = "VIP";
                    $link = "https://drive.google.com/file/d/1DmPlQRhnrhddFdR_0QKDv3XotktQPmX_/view";
                    break;
            }
        }

        return view('pages.load_price', ['title'=>$title, 'link'=>$link]);
    }

    public function contacts(){
        return view('pages.contacts');
    }
}
