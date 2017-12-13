<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $fillable =[
	    'sku',
	    'name',
	    'slug',
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

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function category(){
        return $this->belongsTo(Category::class);
    }

	/**
	 * @param $request
	 *
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
    public function listProducts($request, $uploadPrice){
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

	    // Hide products who hasn't last update
        $lastUpdateProducts = $uploadPrice->where('task_id',2)->latest('id')->first();
        if($lastUpdateProducts){
            $query->where('updated_at', '>',$lastUpdateProducts->created_at->subDay(1));
        }

		return $query->paginate(15);
    }

	/**
	 * Round number to 2 signs
	 * @param $number
	 *
	 * @return float
	 */
    public function roundNumber($number){
        return round($number, 2);
    }

	/**
	 * @param $item
	 * @param $categoryId
	 */
    public function insertOrUpdateProducts($item, $categoryId){

	    $imageURL = '';
		if($this->isImageExist($item['sku'].'.jpeg')){
			$imageURL = '/images/'.$item['sku'].'.jpeg';
		}else{
			$imageURL = '/images/no-image.png';
		}


	    return $this->updateOrCreate(
		    ['sku'         => (integer) $item['sku']],
		    [
			    'name'        => $item['name'],
			    'slug'        => str_slug($item['name'],'-') . '-' . $item['sku'],
			    'description' => $item['description'],

			    'price_user'   => (float) strtr( $item['price_user'], [ ',' => '.' ] ),
			    'price_3_opt'  => (float) strtr( $item['price_3_opt'], [ ',' => '.' ] ),
			    'price_8_opt'  => (float) strtr( $item['price_8_opt'], [ ',' => '.' ] ),
			    'price_dealer' => (float) strtr( $item['price_dealer'], [ ',' => '.' ] ),
			    'price_vip'    => (float) strtr( $item['price_vip'], [ ',' => '.' ] ),

			    'category_id' => $categoryId,
			    'stock'       => $item['stock'],
			    'featured'    => false,
			    'image'       => $imageURL
		    ]
	    );
    }

	/**
	 * Check exist this file in directory
	 * @param $imageFileName
	 *
	 * @return mixed
	 */
    private function isImageExist($imageFileName){
	    return Storage::disk('public_images')->exists($imageFileName);
    }

    public function getProduct($slug){
        return $this->where('slug',$slug)->first();
    }
}
