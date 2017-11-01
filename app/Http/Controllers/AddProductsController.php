<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\PriceParcerController;
use App\Models\Category;

class AddProductsController extends Controller
{
    public function updateProducts(Product $product, Category $category, PriceParcerController $price){
    	$priceData = $price->readPrice();

	    foreach ( $priceData as $item ) {
		    if ( ! $item ) {
			    continue;
		    }
		    $categoryId = $category->takeCategoryId( $item['category'] );

		    $product->insertOrUpdateProducts($item, $categoryId);//todo check returned data, and report if error
	    }

	    return 'updateProducts';
    }
}
