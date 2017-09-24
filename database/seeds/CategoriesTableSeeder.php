<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    private $template = [
        [0,1],
        [0,2],
        [1,3],
        [1,4],
        [2,5],
        [2,6],
        [3,7],
        [3,8],
        [5,9],
        [5,10],
        [6,11],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Category::truncate();
        $faker = \Faker\Factory::create();

        foreach($this->template as $item) {
            $name = $faker->sentence($nbWords = 4, $variableNbWords = true);
            try {
                Category::create([
                    'parent_id' => $item[0],
                    'name' => $name,
                    'slug' => str_slug($name,'-'),
                ]);    
            }catch (Exception $e){}
        }
    }
}
