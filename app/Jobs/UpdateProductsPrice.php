<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class UpdateProductsPrice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;//, SerializesModels;

    protected $productsArray;
    protected $product;
    protected $category;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($arrayPrice, $product, $category)
    {
        $this->productsArray = $arrayPrice;
        $this->product = $product;
        $this->category = $category;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Queue -- ::>>' . count($this->productsArray));

	    foreach ( $this->productsArray as $item ) {
		    if ( ! $item ) {
			    continue;
		    }
		    $categoryId = $this->category->takeCategoryId( $item['category'] );

		    $this->product->insertOrUpdateProducts($item, $categoryId);//todo check returned data, and report if error

	    }
    }
}
