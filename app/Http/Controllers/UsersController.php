<?php

namespace App\Http\Controllers;

use App\Models\PriceType;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function newUser(PriceType $priceType){
        $priceTypeList = $priceType->get();
        return view('admin.usersNew', [
            'priceTypeList'=>$priceTypeList,
        ]);
    }

    public function store(Request $request, User $user){
        $user->create($request->all());
    }
}
