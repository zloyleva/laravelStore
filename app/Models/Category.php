<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable = ['name', 'parent_id', 'slug'];

	private $searchData = [];

    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id');
    }

	/**
	 * Return collection of nested categories
	 * @return array
	 */
    public function getSearchCategory(){
    	return $this->searchData;
    }

	/**
	 * Find category id for current product. Need for insert product.
	 * @param array $categories
	 *
	 * @return int
	 */
    public function takeCategoryId(array $categories){

      $parent_id = 0;
      foreach($categories as $category){
          // Custom filters for current store!!!!
          if($this->isNoNeedCategories($category)){
              continue;
          }
          $category = $this->filterCategoriesNames($category);
          $category = $this->changeCategoryName($category);

          $parent_id = $this->insertOrGetId($category,$parent_id);
      }
      return $parent_id;
    }

    private function isNoNeedCategories($categoryItem){
        if ($categoryItem == "2. Продукция других производителей" || $categoryItem == "1. Наша продукция"){
            return true;
        }
        return false;
    }

    private function changeCategoryName($categoryItem){
        if ($categoryItem == "ИГРУШКА"){
            return "Игрушки";
        }
        return $categoryItem;
    }

    private function filterCategoriesNames($categoryItem){
        $pattern = "/((\d+\.*)+\s)?(\D.+)/";
        return preg_replace($pattern, '$3', $categoryItem);
    }

	/**
	 * Insert or get category. And return this category's id
	 * @param $category
	 * @param $parent_id
	 *
	 * @return mixed
	 */
    private function insertOrGetId($category,$parent_id){
    	if(!$category){
		    $category = 'unCategory';
		    $parent_id = 0;
	    }
      $categoryInstance = $this->firstOrCreate(['name' => $category, 'parent_id' => $parent_id, 'slug' => str_slug($category,'-')]);
      return $categoryInstance->id;
    }

    public function collectCategories(){
    	return $this
		    ->orderBy('parent_id', 'asc')
		    ->orderBy('id', 'asc')
		    ->get()->toArray();
    }

	public function categoryHandler(&$collection,$parent_id,$slug = ''){
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
					if( $slug == $value['slug'] ) {
						$this->searchData['current_cat_id'] = $value['id'];
					}
				}
				$menuHtml .= ($parent_id == 0)?'':'</ul>';
			}
		}
		return $menuHtml;
	}

	public function getCategoryBreadCrumbs($collection, $data){
		$breadcrumbs = [];
		if($data && is_array($collection)){
			foreach ( array_reverse($collection) as $key => $item ) {
				if (isset($data['current_cat_id']) && ($data['current_cat_id'] == $item['id']) ){
					array_unshift($breadcrumbs,[
							'name' => $item['name'],
							'slug' => 'store/category/'.$item['slug'],
						]
					);
					$data['current_cat_id'] = $item['parent_id'];
				}
			}
		}


		array_unshift($breadcrumbs,[
				'name' => 'Магазин',
				'slug' => 'store/',
			]
		);
        array_unshift($breadcrumbs,[
                'name' => '<i class="fa fa-home" aria-hidden="true"></i>',
                'slug' => '',
            ]
        );


        return $breadcrumbs;
	}
}
