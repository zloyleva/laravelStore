<?php

namespace App\Http\Controllers;

use App\Models\UploadPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

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

	public function getFile(UploadPrice $uploadPrice){

		if($connectionId = $uploadPrice->setFtpConnection() ){
			$uploadPrice->upDatePrice($connectionId);
			ftp_close($connectionId);
		}

		return 'upload price ';
	}
}
