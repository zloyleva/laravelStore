<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

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

        for ($i = 1; $i < 600; $i++) {
            try {
                Product::create([
                    'sku' => $faker->numberBetween($min = 1000, $max = 8000),
                    'name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    'description' => $faker->text($maxNbChars = 200),
                    'price' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 1000),
                    'category_id' => $faker->numberBetween($min = 0, $max = 80),
                    'stock' => $faker->numberBetween($min = 1, $max = 5000),
                    'featured' => $faker->boolean($chanceOfGettingTrue = 10),
                    'image' => $faker->imageUrl(),
                ]);    
            }catch (Exception $e){

            }
        }
    }
}
