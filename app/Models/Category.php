<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public static function takeCategoryId(array $categories){

      $parent_id = 0;
      foreach($categories as $category){
        $parent_id = self::insertOrGetId($category,$parent_id);
      }
      return $parent_id;
    }

    private static function insertOrGetId($category,$parent_id){
      $categoryInstanse = Category::firstOrCreate(['name' => $category, 'parent_id' => $parent_id, 'slug' => str_slug($category,'-')]);
      return $categoryInstanse->id;
    }
}
