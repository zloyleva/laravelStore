<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\AddNewUserRequest;
use App\Models\Manager;
use App\Models\PriceType;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function newUser(PriceType $priceType, Manager $manager){
        $managerList = $manager->get();
        $priceTypeList = $priceType->get();
        return view('admin.usersNew', [
            'priceTypeList'=>$priceTypeList,
            'managerList'=>$managerList,
        ]);
    }

    public function store(AddNewUserRequest $request, User $user){
        $user->addNewUser($request->all());
    }
}
