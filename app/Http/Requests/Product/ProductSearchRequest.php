<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\Request;

class ProductSearchRequest extends Request
{
	/**
	 * @var array
	 */
	protected $customValidationRules = [
		'name' => 'string|max:255|nullable',
		'sku' => 'integer|max:10000|nullable',
	];
}
