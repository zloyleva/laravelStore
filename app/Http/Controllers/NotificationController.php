<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class NotificationController extends Controller
{
    public function send_cta(Request $request){

        $name = $request->get('name');
        $phone = $request->get('phone');

        Telegram::sendMessage([
            'chat_id' => env('GROUP_ID2'),
            'text' => "Перезвонить клиенту: {$name}, номер телефона: {$phone}"
        ]);

    }
}
