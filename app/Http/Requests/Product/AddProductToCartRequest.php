<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\Request;

class AddProductToCartRequest extends Request
{
	/**
	 * @var array
	 */
	protected $customValidationRules = [
		'productId' => 'integer|max:10000|min:1|required',
		'qty' => 'integer|max:10000|min:1|required',
	];
}
