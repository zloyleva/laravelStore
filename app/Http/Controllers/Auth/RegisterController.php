<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/after_registration';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|min:6|max:255|unique:users',
//            'email' => 'email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'fname' => 'required|string|min:3|max:255',
            'phone' => 'required|string|min:10|max:12',
            'address' => 'required|string|min:3|max:255',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email']?$data['email']:$data['name'],
            'password' => bcrypt($data['password']),

            'fname' => $data['fname'],
            'phone' => $data['phone'],
            'address' => $data['address'],
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        if($user){

            $message =  "На сайте зарегистрировался новый пользователь.\n";
            $message .= "Тип покупателя <b>{$request->userType}</b>\n";
            $message .= "ФИО <b>{$user->fname}</b>\n";
            $message .= "Логин <b>{$user->name}</b>\n";
            $message .= "Пароль <b>{$request->password}</b>\n";
            $message .= "Телефон <b>{$user->phone}</b>\n";
            $message .= "Город <b>{$user->address}</b>\n";
            $message .= "Email <b>{$user->email}</b>\n";
            $message .= "Коментарий <b>{$request->comment}</b>\n";

            Telegram::sendMessage([
                'chat_id' => env('GROUP_ID2'),
                'text' => $message,
                'parse_mode'=>'HTML'
            ]);
        }

        $this->guard()->login($user);
        $this->guard()->user()->generateToken();

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}
