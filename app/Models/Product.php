<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public function listProducts(){
        return $this->paginate(10);
    }

    public function roundNumber($number){
        return round($number, 2);
    }
}
