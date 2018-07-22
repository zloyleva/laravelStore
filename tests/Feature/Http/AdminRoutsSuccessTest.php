<?php

namespace Tests\Feature\Http;

use Tests\TestCase;
use Tests\ApiEnv;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminRoutsSuccessTest extends TestCase
{
    use ApiEnv;

    private $role = 'admin';

    public function testAdminOrderPage()
    {
        $this->createEnvironment(['role' => $this->role], true);
        $this->get('/admin/orders')->assertStatus(200);
    }

    public function testAdminOrderShowPage()
    {
        $this->createEnvironment(['role' => $this->role], true, true);
        $this->get('/admin/orders/'.$this->order->id)->assertStatus(200);
    }

    public function testAdminProductsPage()
    {
        $this->createEnvironment(['role' => $this->role], true);
        $this->get('/admin/products')->assertStatus(200);
    }

    public function testAdminUsersPage()
    {
        $this->createEnvironment(['role' => $this->role], true);
        $this->get('/admin/users')->assertStatus(200);
    }

    public function testAdminUsersCreatePage()
    {
        $this->createEnvironment(['role' => $this->role], true);
        $this->get('/admin/users/create')->assertStatus(200);
    }

    public function testAdminUsersShowPage()
    {
        $this->createEnvironment(['role' => $this->role], true, false,true);
        $this->get('/admin/users/'.$this->testUser->id.'/edit')->assertStatus(200);
    }

    public function testAdminManagersPage()
    {
        $this->createEnvironment(['role' => $this->role], true);
        $this->get('/admin/managers')->assertStatus(200);
    }

//    public function testAdminGetFilePage()
//    {
//        $this->createEnvironment(['role' => $this->role], true);
//        $this->get('/get_file')->assertStatus(200);
//    }
}
