<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;


class ProductsController extends Controller
{
	/**
	 * @param Product $product
	 * @param Request $request
	 * @param Category $category
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function store(Product $product, Request $request, Category $category){
		return view('store.index', $category->prepareCategory($request, $product));
	}

	/**
	 * @param Product $product
	 * @param Request $request
	 * @param Category $category
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function category(Product $product, Request $request, Category $category){
		return view('store.index', $category->prepareCategory($request, $product));
	}

}
