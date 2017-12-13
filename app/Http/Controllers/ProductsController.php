<?php

namespace App\Http\Controllers;

use App\Models\PriceType;
use App\Models\UploadPrice;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;


class ProductsController extends Controller
{
    /**
     * @param Product $product
     * @param Request $request
     * @param Category $category
     * @param PriceType $priceType
     * @param UploadPrice $uploadPrice
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function store(Product $product, Request $request, Category $category, PriceType $priceType, UploadPrice $uploadPrice){

		$slug = $request->slug;
		$collection = $collection1 = $category->collectCategories();
		$parent_id = 0;

		$categories = $category->categoryHandler($collection,$parent_id,$slug);
		$request->searchData = $category->getSearchCategory()??null;

		return view('store.index', [
				'pageName'=>'Магазин',
				'categories'=>$categories,
				'products'=>$product->listProducts($request, $uploadPrice),
				'breadcrumbs'=>$category->getCategoryBreadCrumbs($collection1, $request->searchData),
                'searchParams'=>[],
                'priceTypeList' => $priceType->get()
			]
		);
	}

	public function showProduct(Request $request, Product $product, Category $category, PriceType $priceType){

	    $productSlug = $request->slug;
        $collection = $collection1 = $category->collectCategories();
        $parent_id = 0;

        $categories = $category->categoryHandler($collection,$parent_id,'');
        return view('product.index', [
                'categories'=>$categories,
                'product'=>$product->getProduct($productSlug),
                'priceTypeList' => $priceType->get()
            ]
        );
    }

}
