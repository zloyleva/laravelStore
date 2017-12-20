<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\ApiEnv;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRoutsTest extends TestCase
{

    use ApiEnv;

    public function testIndexPage()
    {
        $this->createEnvironment(['role' => 'user'], true);
        $this->get('/')->assertStatus(302);
    }

    public function testStorePage()
    {
        $this->createEnvironment(['role' => 'user'], true);
        $this->get('/store')->assertStatus(200);
    }

    public function testStoreCategoryPage()
    {
        $this->createEnvironment(['role' => 'user'], true);
        $category = Category::firstOrFail();
        $this->get('/store/category/' . $category->slug)->assertStatus(200);
    }

    public function testStoreProductPage()
    {
        $this->createEnvironment(['role' => 'user'], true);
        $product = Product::firstOrFail();
        $this->get('/store/product/' . $product->slug)->assertStatus(200);
    }

    public function testStoreSearchPage()
    {
        $this->createEnvironment(['role' => 'user'], true);
        $this->get('/store/search')->assertStatus(200);
    }

    public function testMyProfilePage()
    {
        $this->createEnvironment(['role' => 'user'], true);
        $this->get('/my_profile')->assertStatus(200);
    }

    public function testCartPage()
    {
        $this->createEnvironment(['role' => 'user'], true);
        $this->get('/cart')->assertStatus(200);
    }

    public function testOrderListPage()
    {
        $this->createEnvironment(['role' => 'user'], true);
        $this->get('/orders')->assertStatus(200);
    }

    public function testOrderShowPage()
    {
        $this->createEnvironment(['role' => 'user'], true, true);
        $this->get('/orders/'.$this->order->id)->assertStatus(200);
    }

    public function testEmptyOrderShowPage()
    {
        $this->createEnvironment(['role' => 'user'], true);
        $this->get('/orders/999999999')->assertStatus(302);
    }
}
