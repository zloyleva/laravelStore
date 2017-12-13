<?php

namespace App\Http\Controllers;

use App\Models\PriceType;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\UploadPrice;

class SearchProductsController extends Controller
{
    /**
     * @param Product $product
     * @param Request $request
     * @param Category $category
     * @param PriceType $priceType
     * @param UploadPrice $uploadPrice
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchIndex(Product $product, Request $request, Category $category, PriceType $priceType, UploadPrice $uploadPrice){
	    $slug = $request->slug;
	    $collection = $collection1 = $category->collectCategories();
	    $parent_id = 0;

	    $categories = $category->categoryHandler($collection,$parent_id,$slug);
	    $request->searchData = $category->getSearchCategory()??null;

	    $pageName =  'Страница поиска. Вы искали "' . $request->input($request->input('inputData')) . '"';

	    return view('store.index', [
			    'pageName'=>$pageName,
			    'categories'=>$categories,
			    'products'=>$product->listProducts($request, $uploadPrice),
			    'breadcrumbs'=>$category->getCategoryBreadCrumbs($collection1, $request->searchData),
                'searchParams'=>[
                    'inputData'=>$request->input('inputData'),
                    $request->input('inputData')=>$request->input($request->input('inputData'))
                ],
                'priceTypeList' => $priceType->get()
		    ]
	    );
    }
}
