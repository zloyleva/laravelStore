<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class RegisterRequest extends Request
{
	/**
	 * @var array
	 */
	protected $customValidationRules = [
        'email' => "required|email|unique:users",
	];

    public function messages()
    {
        return [
            'email.unique' => 'Пользователь с таким email уже существует',
        ];
    }
}
