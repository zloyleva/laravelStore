<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class SearchProductsController extends Controller
{
    public function searchIndex(Product $product, Request $request, Category $category){
	    $slug = $request->slug;
	    $collection = $collection1 = $category->collectCategories();
	    $parent_id = 0;

	    $categories = $category->categoryHandler($collection,$parent_id,$slug);
	    $request->searchData = $category->getSearchCategory()??null;

	    return view('store.index', [
			    'pageName'=>'Search',
			    'categories'=>$categories,
			    'products'=>$product->listProducts($request),
			    'breadcrumbs'=>$category->getCategoryBreadCrumbs($collection1, $request->searchData)
		    ]
	    );
    }
}
