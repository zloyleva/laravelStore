<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminDashboardController extends Controller
{
    //
    public function listOrders(){
      return view('admin.index',[
          'data'=> '',
      ]);;
    }
}
