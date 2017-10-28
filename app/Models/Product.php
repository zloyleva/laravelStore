<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Http\Request;

class Product extends Model
{
    //
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
}
