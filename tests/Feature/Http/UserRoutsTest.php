<?php

namespace Tests\Feature\Http;

use Tests\TestCase;
use Tests\ApiEnv;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRoutsTest extends TestCase
{

    private $role = 'user';
    use ApiEnv;

    public function testIndexPage()
    {
        $this->createEnvironment(['role' => $this->role], true);
        $this->get('/')->assertStatus(200);
    }

    public function testStorePage()
    {
        $this->createEnvironment(['role' => $this->role], true);
        $this->get('/store')->assertStatus(200);
    }

    public function testStoreCategoryPage()
    {
        $this->createEnvironment(['role' => $this->role], true);
        $category = Category::firstOrFail();
        $this->get('/store/category/' . $category->slug)->assertStatus(200);
    }

    public function testStoreProductPage()
    {
        $this->createEnvironment(['role' => $this->role], true);
        $product = Product::firstOrFail();
        $this->get('/store/product/' . $product->slug)->assertStatus(200);
    }

    public function testStoreSearchPage()
    {
        $this->createEnvironment(['role' => $this->role], true);
        $this->get('/store/search')->assertStatus(200);
    }

    public function testMyProfilePage()
    {
        $this->createEnvironment(['role' => $this->role], true);
        $this->get('/my_profile')->assertStatus(200);
    }

    public function testCartPage()
    {
        $this->createEnvironment(['role' => $this->role], true);
        $this->get('/cart')->assertStatus(200);
    }

    public function testOrderListPage()
    {
        $this->createEnvironment(['role' => $this->role], true);
        $this->get('/orders')->assertStatus(200);
    }

    public function testOrderShowPage()
    {
        $this->createEnvironment(['role' => $this->role], true, true);
        $this->get('/orders/'.$this->order->id)->assertStatus(200);
    }

    public function testEmptyOrderShowPage()
    {
        $this->createEnvironment(['role' => $this->role], true);
        $this->get('/orders/999999999')->assertStatus(302);
    }

    public function testAdminOrderPage()
    {
        $this->createEnvironment(['role' => $this->role], true);
        $this->get('/admin/orders')->assertStatus(302);
    }

    public function testAdminOrderShowPage()
    {
        $this->createEnvironment(['role' => $this->role], true, true);
        $this->get('/admin/orders/'.$this->order->id)->assertStatus(302);
    }

    public function testAdminProductsPage()
    {
        $this->createEnvironment(['role' => $this->role], true);
        $this->get('/admin/products')->assertStatus(302);
    }

    public function testAdminUsersPage()
    {
        $this->createEnvironment(['role' => $this->role], true);
        $this->get('/admin/users')->assertStatus(302);
    }

    public function testAdminUsersCreatePage()
    {
        $this->createEnvironment(['role' => $this->role], true);
        $this->get('/admin/users/create')->assertStatus(302);
    }

    public function testAdminUsersShowPage()
    {
        $this->createEnvironment(['role' => $this->role], true, false,true);
        $this->get('/admin/users/'.$this->testUser->id.'/edit')->assertStatus(302);
    }

    public function testAdminManagersPage()
    {
        $this->createEnvironment(['role' => $this->role], true);
        $this->get('/admin/managers')->assertStatus(302);
    }

//    public function testAdminGetFilePage()
//    {
//        $this->createEnvironment(['role' => $this->role], true);
//        $this->get('/get_file')->assertStatus(302);
//    }
}
