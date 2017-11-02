<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MyProfileController extends Controller
{
    public function updateMyProfileData(User $user,Request $request){
    	//name,fname,lname,address,phone
	    $args = [];

	    if($request->name){
		    $args['name'] = $request->name;
	    }
	    if($request->fname){
		    $args['fname'] = $request->fname;
	    }
	    if($request->lname){
		    $args['lname'] = $request->lname;
	    }
	    if($request->address){
		    $args['address'] = $request->address;
	    }
	    if($request->phone){
		    $args['phone'] = $request->phone;
	    }

	    if($args){
		    $user->where('id', Auth::user()->id)->update($args);
	    }else{
		    return $this->jsonResponse(['error'=>'Error data']);
	    }

	    return $this->jsonResponse($user->where('id', Auth::user()->id)->first());
    }

    public function updateMyProfilePassword(User $user,Request $request){
	    $args = [];

	    if($request->password && $request->password_confirmation){
		    $args['password'] = bcrypt($request->password);
	    }


	    if($args){
		    $user->where('id', Auth::user()->id)->update($args);
	    }else{
		    return $this->jsonResponse(['error'=>'Error data']);
	    }
	    return $this->jsonResponse($user->where('id', Auth::user()->id)->first());
    }
}
