<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\UploadPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;
use App\Jobs\UpdateProductsPrice;
use Carbon\Carbon;

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

	public function queueMethod(Product $product, Category $category){

		$chunkSize = 250;

		//Read price to array
		$localPriceName = storage_path('price/price.json');

		while(true){

			$productsPriceArray = file($localPriceName);
			$ChunkToUpload = [];
			//Slice from array chunks(200 ps)
			$chunkItemCounts = (count($productsPriceArray)<$chunkSize)?count($productsPriceArray):$chunkSize;
			for($i=0;$i<$chunkItemCounts;$i++){
				$ChunkToUpload[] = json_decode($productsPriceArray[$i], JSON_UNESCAPED_UNICODE );
				unset($productsPriceArray[$i]);
			}

			//Call Queue and pass it chunk data and slice data array
			$this->sendToQueue($ChunkToUpload, $product, $category);
			dd('STOP');
			if(count($productsPriceArray)<1){
				//finish read price
				//if data's array empty - write to DB - update price is done ->> Pass status last chunk for set it
				//delete price file
				return 'finish upload';
			}

			file_put_contents($localPriceName, $productsPriceArray);
		}
	}

	private function sendToQueue($ChunkToUpload, $product, $category){

		$jobUploadPrice = (new UpdateProductsPrice($ChunkToUpload, $product, $category))->delay(Carbon::now()->addSeconds(50));
		dispatch($jobUploadPrice);
	}
}
