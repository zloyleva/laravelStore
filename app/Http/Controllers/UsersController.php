<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\AddNewUserRequest;
use App\Models\Manager;
use App\Models\PriceType;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function createUser(PriceType $priceType, Manager $manager){
        $managerList = $manager->get();
        $priceTypeList = $priceType->get();
        return view('admin.usersNew', [
            'priceTypeList'=>$priceTypeList,
            'managerList'=>$managerList,
            'roles'=>['user','manager','admin']
        ]);
    }

    public function store(AddNewUserRequest $request, User $user){
        return $this->jsonResponse( [
            'user'=>$user->addNewUser($request->all()),
            'redirectUrl'=>route('admin.users.index'),
            'message'=>'Успешно добавлен новый пользователь',
        ]);
    }

    /**
     * Show user edit form
     *
     * @param PriceType $priceType
     * @param Manager $manager
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editUser(PriceType $priceType, Manager $manager, User $user, Request $request){
        $userEdit = $user->where('id', $request->id)->first();
        $managerList = $manager->get();
        $priceTypeList = $priceType->get();

        return view('admin.usersNew', [
            'user'=>$userEdit,
            'priceTypeList'=>$priceTypeList,
            'managerList'=>$managerList,
            'roles'=>['user','manager','admin']
        ]);
    }


    public function updateUser(Request $request, User $user){

        return $this->jsonResponse( [
            'user'=>$user->updateUser($request->all()),
            'redirectUrl'=>route('admin.users.index'),
            'message'=>'Успешно обновили данные пользователя',
        ]);
    }
}
