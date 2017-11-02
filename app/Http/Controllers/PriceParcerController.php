<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PriceParcerController extends Controller
{
    //
    public function readPrice(){
      $data = collect( explode(PHP_EOL, Storage::disk('local')->get('price.json') ) )->map(function($item){

        $item = json_decode($item, JSON_UNESCAPED_UNICODE);
        // switch (json_last_error()) {
        //         case JSON_ERROR_NONE:
        //             echo ' - Ошибок нет'."\n";
        //         break;
        //         case JSON_ERROR_DEPTH:
        //             echo ' - Достигнута максимальная глубина стека';
        //         break;
        //         case JSON_ERROR_STATE_MISMATCH:
        //             echo ' - Некорректные разряды или не совпадение режимов';
        //         break;
        //         case JSON_ERROR_CTRL_CHAR:
        //             echo ' - Некорректный управляющий символ';
        //         break;
        //         case JSON_ERROR_SYNTAX:
        //             echo ' - Синтаксическая ошибка, не корректный JSON'."\n";
        //         break;
        //         case JSON_ERROR_UTF8:
        //             echo ' - Некорректные символы UTF-8, возможно неверная кодировка';
        //         break;
        //         default:
        //             echo ' - Неизвестная ошибка'."\n";
        //         break;
        //     }
        //     print_r($item);
        //     echo "\n";
        return $item;
      });

      return $data;
    }
}
