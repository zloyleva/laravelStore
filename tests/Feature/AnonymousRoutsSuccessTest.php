<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnonymousRoutsSuccessTest extends TestCase
{
	public function testIndexPage()
	{
		$this->get('/')->assertStatus(200);
	}

	public function testStorePage()
	{
		$this->get('/store')->assertStatus(200);
	}

	public function testStoreSecondPagePage()
	{
		$this->get('/store?page=2')->assertStatus(200);
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
		$this->get('/logout')->assertStatus(405);
	}


	public function testCartPage()
	{
		$this->get('/cart')->assertStatus(302);
	}

	public function testOrdersPage()
	{
		$this->get('/orders/list')->assertStatus(302);
	}
}
