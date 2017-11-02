<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Http\Request;

class Product extends Model
{
    protected $fillable =[
	    'sku',
	    'name',
	    'description',
	    'price_user',
	    'price_3_opt',
	    'price_8_opt',
	    'price_dealer',
	    'price_vip',
	    'category_id',
	    'stock',
	    'featured',
	    'image',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function listProducts($request){
		$query = $this->with(['category']);

	    if(isset( ($request->searchData)['result'])){
			$query->whereIn('category_id', ($request->searchData)['result']);
        }

        if( isset($request->inputData) && $request->inputData == 'name' && is_string($request->name) ){
	        $query->where('name', 'like',"%{$request->name}%");
//todo add custom url for search	        $query->withPath('custom/url');
        }elseif ( isset($request->inputData) && $request->inputData == 'sku' && is_numeric($request->sku) ){
		    $query->where('sku', 'like',"%{$request->sku}%");
	    }

		return $query->paginate(5);
    }

    public function roundNumber($number){
        return round($number, 2);
    }

	/**
	 * @param $item
	 * @param $categoryId
	 */
    public function insertOrUpdateProducts($item, $categoryId){
	    $faker = \Faker\Factory::create();
	    return $this->updateOrCreate(
		    ['sku'         => (integer) $item['sku']],
		    [
//		    	'sku'         => (integer) $item['sku'],
			    'name'        => $item['name'],
			    'description' => $item['description'],

			    'price_user'   => (float) strtr( $item['price_user'], [ ',' => '.' ] ),
			    'price_3_opt'  => (float) strtr( $item['price_3_opt'], [ ',' => '.' ] ),
			    'price_8_opt'  => (float) strtr( $item['price_8_opt'], [ ',' => '.' ] ),
			    'price_dealer' => (float) strtr( $item['price_dealer'], [ ',' => '.' ] ),
			    'price_vip'    => (float) strtr( $item['price_vip'], [ ',' => '.' ] ),

			    'category_id' => $categoryId,
			    'stock'       => $item['stock'],
			    'featured'    => $faker->boolean( $chanceOfGettingTrue = 10 ),
			    'image'       => $faker->imageUrl()
		    ]
	    );
    }
}
