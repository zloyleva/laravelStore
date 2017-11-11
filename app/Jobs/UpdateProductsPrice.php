<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

use App\Models\Category;
use App\Models\Product;

class UpdateProductsPrice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $productsArray;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($arrayPrice)
    {
        $this->productsArray = $arrayPrice;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Queue -- ::>>' . count($this->productsArray));

	    $faker = \Faker\Factory::create();
	    $category = new Category();

	    foreach ( $this->productsArray as $item ) {
		    if ( ! $item ) {
			    continue;
		    }
		    $categoryId = $category->takeCategoryId( $item['category'] );

		    Product::create( [
			    'sku'         => (integer) $item['sku'],
			    'name'        => $item['name'],
			    'description' => $item['description'],

			    'price_user'   => (float) strtr( $item['price_user'], [ ',' => '.' ] ),
			    'price_3_opt'  => (float) strtr( $item['price_3_opt'], [ ',' => '.' ] ),
			    'price_8_opt'  => (float) strtr( $item['price_8_opt'], [ ',' => '.' ] ),
			    'price_dealer' => (float) strtr( $item['price_dealer'], [ ',' => '.' ] ),
			    'price_vip'    => (float) strtr( $item['price_vip'], [ ',' => '.' ] ),

			    'category_id' => $categoryId,
			    'stock'       => $item['stock'],
			    'featured'    => $faker->boolean( $chanceOfGettingTrue = 10 ),
			    'image'       => $faker->imageUrl(),
		    ] );
	    }
    }
}
