<?php

namespace Tests\Feature\Http;

use Tests\TestCase;
use Tests\ApiEnv;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnonymousRoutsSuccessTest extends TestCase
{
    use ApiEnv;

	public function testIndexPage()
	{
		$this->get('/')->assertStatus(200);
	}

    public function testLoadPricePage()
    {
        $this->get('/load_price')->assertStatus(200);
    }

    public function testSalesPricePage()
    {
        $this->get('/sales_price')->assertStatus(200);
    }

    public function testContactsPage()
    {
        $this->get('/contacts')->assertStatus(200);
    }

    public function testAboutUsPage()
    {
        $this->get('/about_us')->assertStatus(200);
    }

    public function testPayPage()
    {
        $this->get('/pay')->assertStatus(200);
    }

    public function testSiteMapPage()
    {
        $this->get('/site_map')->assertStatus(200);
    }

	public function testStorePage()
	{
		$this->get('/store')->assertStatus(200);
	}

    public function testStoreCategoryPage()
    {
        $category = Category::firstOrFail();
        $this->get('/store/category/' . $category->slug)->assertStatus(200);
    }

    public function testStoreProductPage()
    {
        $product = Product::firstOrFail();
        $this->get('/store/product/' . $product->slug)->assertStatus(200);
    }

    public function testStoreSearchPage()
    {
        $this->get('/store/search')->assertStatus(200);
    }

	public function testLoginPage()
	{
		$this->get('/login')->assertStatus(200);
	}

	public function testRegisterPage()
	{
		$this->get('/register')->assertStatus(200);
	}

	public function testLogoutPage()
	{
		$this->get('/logout')->assertStatus(302);
	}

	public function testCartPage()
	{
		$this->get('/cart')->assertStatus(302);
	}

	public function testOrdersPage()
	{
		$this->get('/orders')->assertStatus(302);
	}

    public function testOrderShowPage()
    {
        $this->createEnvironment(['role' => 'user'], false, true);
        $this->get('/orders/'.$this->order->id)->assertStatus(302);
    }

    public function testEmptyOrderShowPage()
    {
        $this->get('/orders/999999999')->assertStatus(302);
    }

    public function testMyProfilePage()
    {
        $this->get('/my_profile')->assertStatus(302);
    }

    /**
     * Admin section
     */
    public function testAdminOrdersPage()
    {
        $this->get('/admin/orders')->assertStatus(302);
    }

    public function testAdminProductsPage()
    {
        $this->get('/admin/products')->assertStatus(302);
    }

    public function testAdminUsersPage()
    {
        $this->get('/admin/users')->assertStatus(302);
    }

    public function testAdminUsersCreatePage()
    {
        $this->get('/admin/users/create')->assertStatus(302);
    }

    public function testAdminManagersPage()
    {
        $this->get('/admin/managers')->assertStatus(302);
    }

    /**
     * Click link
     */
}
