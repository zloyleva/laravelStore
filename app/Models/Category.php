<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	private $menuHtml;
	private $searchData = [];

    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id');
    }

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

    public function collectCategories(){
    	return $this
		    ->orderBy('parent_id', 'asc')
		    ->orderBy('id', 'asc')
		    ->get()->toArray();
    }

	public function prepareCategory($request,$product){

    	$slug = $request->slug;
		$collection = $collection1 = $this->collectCategories();
		$parent_id = 0;

		return [
			'categories'=>$this->categoryHandler($collection,$parent_id,$slug),
			'products'=>$product->listProducts($this->searchData??null),
			'breadcrumbs'=>$this->getCategoryBreadCrumbs($collection1, $this->searchData??null)
		];
	}

	private function categoryHandler(&$collection,$parent_id,$slug = ''){
		$menuHtml = '';
		$slug_id = $this->searchData['find']??null;
		foreach( $collection as $key => $value ){

			if($value['parent_id'] == $parent_id){

				unset($collection[$key]);

				$menuHtml .= ($parent_id == 0)?'':'<ul class="sub_menu">';

				if( $slug == $value['slug'] || (isset($slug_id) && $slug_id == $value['parent_id'] ) ){
					$this->searchData['result'][] = $value['id'];
					$this->searchData['find'] = $value['id'];
				}

				if(count($collection)>0){

					$menuHtml .= '<li class="dropdown_item"><a href="/store/category/'.$value['slug'].'" class="dropdown_link ';
					if( $slug == $value['slug'] ){
						$menuHtml .=    'active';
						$this->searchData['current_cat_id'] = $value['id'];
					}
					$menuHtml .=    '">'.$value['name'];

					$menuHtml .=    ($sub_menu = $this->categoryHandler($collection,$value['id'],$slug))?'<span class="caret"></span></a>'.$sub_menu:'</a>';

					$menuHtml .= '</li>';
				}else{
					$menuHtml .= '<li><a href="/store/category/'.$value['slug'].'" class="';
					$menuHtml .=    ($slug == $value['slug'])?'active':'';
					$menuHtml .=    '">'.$value['name'].'</a></li>';
				}
				$menuHtml .= ($parent_id == 0)?'':'</ul>';
			}
		}
		return $menuHtml;
	}

	public function getCategoryBreadCrumbs($collection, $data){

		if(!$data || !is_array($collection)) return null; //todo: Return only HOME link
		$breadCrumbs = [];
		foreach ( array_reverse($collection) as $key => $item ) {
			if ($data['current_cat_id'] == $item['id']){
				array_unshift($breadCrumbs,[
						'name' => $item['name'],
						'slug' => $item['slug'],
					]
				);
				$data['current_cat_id'] = $item['parent_id'];
			}
		}
//		dd($breadCrumbs);



		return $breadCrumbs;
	}
}
