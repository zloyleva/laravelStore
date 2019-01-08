<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $fillable =[
        'sku',
        'name',
        'slug',
        'description',
        'price_user',
        'price_3_opt',
        'price_8_opt',
        'price_dealer',
        'price_vip',
        'category_id',
        'stock',
        'featured',
        'image',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(){
        return $this->belongsTo(Category::class);
    }

    /**
     * @param $request
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function listProducts($request, $uploadPrice){
        $query = $this->with(['category']);

        if(isset( ($request->searchData)['result'])){
            $query->whereIn('category_id', ($request->searchData)['result']);
        }

        if( isset($request->inputData) && $request->inputData == 'name' && is_string($request->name) ){
            $query->where('name', 'like',"%{$request->name}%");
            //todo add custom url for search	        $query->withPath('custom/url');
        }elseif ( isset($request->inputData) && $request->inputData == 'sku' && is_numeric($request->name) ){
            $query->where('sku', 'like',"%{$request->name}%");
        }

        // Hide products who hasn't last update
        $lastUpdateProducts = $uploadPrice->where('task_id',2)->latest('id')->first();
        if($lastUpdateProducts){
            $query->where('updated_at', '>',$lastUpdateProducts->created_at->subDay(1));
        }

        if (isset($request->sort_products) && ($request->sort_products == 'asc' || $request->sort_products == 'desc')) {
            $query->orderBy('price_user', $request->sort_products);
        }else{
            $query->orderBy('name', 'asc');
        }

        return $query->paginate(15);
    }

    /**
     * Round number to 2 signs
     * @param $number
     *
     * @return float
     */
    public function roundNumber($number){
        return round($number, 2);
    }

    /**
     * @param $items
     * @param $category
     * @return mixed
     */
    public function insertOrUpdateProducts($items, $category){

        if(!is_array($items) || count($items) < 1){
            Log::info('insertOrUpdateProducts -- ::>> error data');
            return "";
        }


        $vowels = ['"', "'"];

        $items_link = &$items;
        $queryArrayInsert = [];
        $errorCat = [];

        foreach ($items_link as $item){

            if(true){
                $item = preg_replace('/\s+/', ' ', $item);
                $item =  preg_replace('~(\\\)([^"])~', "/$2", $item);

                $errorItem = $item;

                $item = json_decode($item, JSON_UNESCAPED_UNICODE);

                if(!$item['category']){
                    $errorCat[] = $errorItem;
                    continue;
                }
                $categoryId = $category->takeCategoryId( $item['category'] );

                if($this->isImageExist($item['sku'].'.jpeg')){
                    $imageURL = '/images/'.$item['sku'].'.jpeg';
                }else{
                    $imageURL = '/images/no-image.png';
                }

                $name = str_replace($vowels, "", $item['name']);
                $description = str_replace($vowels, "", $item['description']);
                $slug = str_slug($item['name'],'-') . '-' . $item['sku'];
                $created = Carbon::now('Europe/Kiev')->toDateTimeString();
                $updated = Carbon::now('Europe/Kiev')->toDateTimeString();

                $oneRow = [
                    'sku'           => (integer) $item['sku'],
                    'name'          => "'{$name}'",
                    'slug'          => "'{$slug}'",
                    'description'   => "'{$description}'",
                    'price_user'    => (float) strtr( $item['price_user'], [ ',' => '.' ] ),
                    'price_3_opt'   => (float) strtr( $item['price_3_opt'], [ ',' => '.' ] ),
                    'price_8_opt'   => (float) strtr( $item['price_8_opt'], [ ',' => '.' ] ),
                    'price_dealer'  => (float) strtr( $item['price_dealer'], [ ',' => '.' ] ),
                    'price_vip'     => (float) strtr( $item['price_vip'], [ ',' => '.' ] ),
                    'category_id'   => $categoryId,
                    'stock'         => filter_var($item['stock'], FILTER_SANITIZE_NUMBER_INT),
                    'featured'      => 0,
                    'image'         => "'{$imageURL}'",
                    'created_at'    => "'{$created}'",
                    'updated_at'    => "'{$updated}'"
                ];

                $concatSrt = " ({$oneRow['sku']},{$oneRow['name']},{$oneRow['slug']},{$oneRow['description']},{$oneRow['price_user']}";
                $concatSrt .= ",{$oneRow['price_3_opt']},{$oneRow['price_8_opt']},{$oneRow['price_dealer']},{$oneRow['price_vip']}";
                $concatSrt .= ",{$oneRow['category_id']},{$oneRow['stock']},{$oneRow['featured']},{$oneRow['image']},{$oneRow['created_at']},{$oneRow['updated_at']}) ";

                $queryArrayInsert[] = $concatSrt;
            }
        }

        if(!count($queryArrayInsert)){
            Log::info('insertOrUpdateProducts -- ::>> error data prepare data');
            return "";
        }

        Log::info('Products -- ::>>' . count($queryArrayInsert));
        if(count($errorCat)){
            Log::info('errorCat -- ::>>' . count($errorCat));
            Log::info(print_r($errorCat, true));
        }

        $queryStr = "insert into `forge`.`products` (`sku`, `name`, `slug`, `description`, `price_user`, `price_3_opt`, `price_8_opt`, `price_dealer`, `price_vip`, `category_id`,`stock`,`featured`,`image`,`created_at`,`updated_at`) values";

        $queryStr .= implode(",", $queryArrayInsert);
        $queryStr .= " on duplicate key update name=VALUES(name), slug=VALUES(slug), description=VALUES(description), price_user=VALUES(price_user), ";
        $queryStr .= "price_3_opt=VALUES(price_3_opt), price_8_opt=VALUES(price_8_opt), price_dealer=VALUES(price_dealer), price_vip=VALUES(price_vip), ";
        $queryStr .= "category_id=VALUES(category_id), stock=VALUES(stock), featured=VALUES(featured), image=VALUES(image), updated_at=VALUES(updated_at); ";

        return DB::statement($queryStr);
    }

    /**
     * Check exist this file in directory
     * @param $imageFileName
     *
     * @return mixed
     */
    private function isImageExist($imageFileName){
        return Storage::disk('public_images')->exists($imageFileName);
    }

    public function getProduct($slug){
        return $this->where('slug',$slug)->firstOrFail();
    }
}
