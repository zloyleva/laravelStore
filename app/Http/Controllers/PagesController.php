<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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
}
