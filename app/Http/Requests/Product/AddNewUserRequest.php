<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\Request;

class AddNewUserRequest extends Request
{
	/**
	 * @var array
	 */
	protected $customValidationRules = [
        'name' => 'string|max:255|required',
        'fname' => 'string|max:255|nullable',
        'lname' => 'string|max:255|nullable',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'string|max:255|required',
        'role' => 'string|max:255|nullable',
        'price_type' => 'integer|max:10|min:1|required',
        'address' => 'string|max:255|nullable',
        'phone' => 'string|max:15|nullable',
        'manager_id' => 'integer|max:10|min:1|required'
	];
}
