<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminDashboardController extends Controller
{
    //
    public function listOrders(){
      return view('admin.listOrders',[
          'data'=> '',
      ]);;
    }

	public function addProducts(){
		return view('admin.addProducts',[
			'data'=> '',
		]);;
	}

	public function getFile(){
//		return Storage::disk('ftp')->exists('price1.json')?'true':'false';
//		return Storage::disk('ftp')->lastModified('price.json');
		Storage::disk('local')->put('new.file', Storage::disk('ftp')->get('price.json'), 'public');
		Storage::setVisibility('new.file', 'public');
		return 'upload';
	}
}
