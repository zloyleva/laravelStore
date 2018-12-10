<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

	    //global data
	    view()->composer('*', function($view){

		   $categories = Category::get()->toArray();

		   $menu = [];

		   foreach ($categories as $category_key => $category){

			    if($category['parent_id'] == 0){

				    $children_lvl_1 = [];
				    foreach ($categories as $child_lvl_1_key => $child_lvl_1){

					    if($child_lvl_1['parent_id'] == $category['id']){
						    $children_lvl_1[$child_lvl_1_key] = $child_lvl_1;

						    $children_lvl_2 = [];
						    foreach ($categories as $child_lvl_2_key => $child_lvl_2){
						    	if($child_lvl_2['parent_id'] == $child_lvl_1['id']){
								    $children_lvl_2[$child_lvl_2_key] = $child_lvl_2;
							    }

							    $children_lvl_1[$child_lvl_1_key]['children2'] = $children_lvl_2;
						    }
					    }
				    }

				    $menu[$category_key] = $category;
				    $menu[$category_key]['children'] = $children_lvl_1;
			    }
		   }

//		   dd($menu);

		    $view->with('menu', $menu);

		    if(Auth::check()){
                $identifcator = Auth::user()->id;
            }else {
                $identifcator = $this->app->request->cookie('user_ids');
            }

            $stored = DB::table('shoppingcart')->where('identifier', $identifcator)->first();

		    $cartCount = 0;
		    if($stored){
			    $cartCount = count(unserialize($stored->content));
		    }

		    $view->with('cart_count', $cartCount);

	    });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
