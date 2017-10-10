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

    public function listProducts($data){
		$query = $this->with(['category']);

	    if(isset($data['result'])){
			$query->whereIn('category_id', $data['result']);
        }

		return $query->paginate(10);
    }

    public function roundNumber($number){
        return round($number, 2);
    }
}
