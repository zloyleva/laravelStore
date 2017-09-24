<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    //
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function listProducts(){
        return $this->with(['category'])->paginate(10);
    }

    public function roundNumber($number){
        return round($number, 2);
    }
}
