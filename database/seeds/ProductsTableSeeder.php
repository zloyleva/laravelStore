<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Product::truncate();
        $faker = \Faker\Factory::create();
        $categories = Category::all()->toArray();

        for ($i = 1; $i < 50; $i++) {
            $userPrice = $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 1000);
            try {
                Product::create([
                    'sku' => $faker->numberBetween($min = 1000, $max = 8000),
                    'name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    'description' => $faker->text($maxNbChars = 200),

                    'price_user' => $userPrice,
                    'price_3_opt' => $userPrice - $userPrice*0.1,
                    'price_8_opt' => $userPrice - $userPrice*0.2,
                    'price_dealer' => $userPrice - $userPrice*0.3,
                    'price_vip' => $userPrice - $userPrice*0.4,

                    'category_id' => $faker->randomElements($categories)[0]['id'],
                    'stock' => $faker->numberBetween($min = 1, $max = 5000),
                    'featured' => $faker->boolean($chanceOfGettingTrue = 10),
                    'image' => $faker->imageUrl(),
                ]);        
            }catch (Exception $e){

            }
        }
    }
}
