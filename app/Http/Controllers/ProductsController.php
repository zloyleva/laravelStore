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

        $selectStatus = [
            'default' => 'selected',
            'asc'=>'',
            'desc'=>'',
        ];

        if(isset($request->sort_products) && strlen($request->sort_products) > 2){
            $searchParams = ['sort_products'=>$request->sort_products];
            $selectStatus['default'] = '';
            $selectStatus[$request->sort_products] = 'selected';
        }

        $header_title = null;
        if($slug && $currentCategory = $category->where('slug', $slug)->first()){
            $header_title = "Категория товаров: {$currentCategory->name}";
        }


        return view('store.index', [
                'pageName'=> $header_title??"Магазин",
                'categories'=>$categories,
                'products'=>$product->listProducts($request, $uploadPrice),
                'breadcrumbs'=>$category->getCategoryBreadCrumbs($collection1, $request->searchData),
                'priceTypeList' => $priceType->get(),
                'sku_checked'=>false,
                'name_checked'=>true,
                'searchParams'=>$searchParams??'',
                'selectStatus'=>$selectStatus,
                'header_title'=>$header_title,
            ]
        );
    }

    public function showProduct(Request $request, Product $product, Category $category, PriceType $priceType){

        $productSlug = $request->slug;
        $getProduct = $product->getProduct($productSlug);
        $collection = $collection1 = $category->collectCategories();
        $parent_id = 0;

        $categories = $category->categoryHandler($collection,$parent_id,'');

        return view('product.index', [
                'categories'=>$categories,
                'product'=>$getProduct,
                'priceTypeList' => $priceType->get(),
                'og'=>[
                    'title'=>$getProduct->name,
                    'description'=>(count($getProduct->description)>3)?$getProduct->description:$getProduct->name,
                    'image'=>url('/') . $getProduct->image
                ],
                'header_title' => "Товары: " . $getProduct->name,
                'header_description'=>(count($getProduct->description)>3)?$getProduct->description:$getProduct->name,
            ]
        );
    }

}
