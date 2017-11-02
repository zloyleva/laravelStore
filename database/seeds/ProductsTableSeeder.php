<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\PriceParserController;

class ProductsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		//
		$price     = new PriceParserController;
		$priceData = $price->readPrice();

		Product::truncate();
		$faker = \Faker\Factory::create();

		foreach ( $priceData as $item ) {
			if ( ! $item ) {
				continue;
			}
			$categoryId = Category::takeCategoryId( $item['category'] );

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
