<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchProductsController extends Controller
{
    public function searchIndex(Request $request){
    	return $request->search;
    }
}
