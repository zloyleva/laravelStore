<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class UploadPrice extends Model
{
	protected $fillable = [
		'task_id',
		'name',
		'message',
		'done'
	];

	public function setFtpConnection(){
		if(!$connectionId = ftp_connect( env('FTP_HOST') )){
			$this->errorLoadPrice("Don't connect to server ".env('FTP_HOST') );
		}
		return $connectionId;
	}

	public function upDatePrice($connectionId){
		$serverFile = 'price.json';
		$local_file = storage_path('price/price.json');

		try{
			ftp_login($connectionId, env('FTP_USERNAME'), env('FTP_PASSWORD'));
		}catch (\Exception $e){
			return $this->errorLoadPrice("Wrong login or password to server ".env('FTP_HOST') );
		}

		if( !Storage::disk('ftp')->exists($serverFile) ){
			return $this->errorLoadPrice("File don't find on server");
		}

		ftp_pasv($connectionId, true);

		if (ftp_get($connectionId, $local_file, $serverFile, FTP_BINARY)) {
			$success = $this->successLoadPrice("Load price is done");
		} else {
			return $this->errorLoadPrice("Can't load price from server");
		}

		chmod($local_file, 0777);
		return $success;
	}
	/**
	 * @param $error
	 */
    private function errorLoadPrice($error){
		return $this->create([
			'task_id'=>1,
			'name'=>'Load price',
			'message'=>$error,
			'done'=>false
		]);
    }

	/**
	 * @param $success
	 */
	private function successLoadPrice($success){
		return $this->create([
			'task_id'=>1,
			'name'=>'Load price',
			'message'=>$success,
			'done'=>true
		]);
	}
}
