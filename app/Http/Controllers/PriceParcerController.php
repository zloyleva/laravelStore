<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PriceParcerController extends Controller
{
    //
    public function readPrice(){
      $data = collect( explode(PHP_EOL, Storage::disk('local')->get('price') ) )->map(function($item){
        $item = json_decode($item, JSON_UNESCAPED_UNICODE);

        return $item;
      });
      return $data;
    }
}
