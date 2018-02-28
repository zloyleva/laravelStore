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

	    // Check input data for exist
	    if( $request->input('inputData') != null ){
            $pageName =  'Страница поиска. Вы искали "' . $request->input('name') . '"';
        }else{
            $pageName = 'Магазин';
        }

        $sku_checked = false;
        $name_checked = false;
        switch (true){
            case ($request->input('inputData') == 'sku'):
                $sku_checked = true;
                break;
            case ($request->input('inputData') == 'name'):
                $name_checked = true;
                break;
        }


	    return view('store.index', [
			    'pageName'=>$pageName,
			    'categories'=>$categories,
			    'products'=>$product->listProducts($request, $uploadPrice),
			    'breadcrumbs'=>$category->getCategoryBreadCrumbs($collection1, $request->searchData),
                'searchParams'=>[
                    'inputData'=>$request->input('inputData'),
                    $request->input('inputData')=>$request->input('name')
                ],
                'priceTypeList' => $priceType->get(),
                'sku_checked'=>$sku_checked,
                'name_checked'=>$name_checked,
		    ]
	    );
    }
}
