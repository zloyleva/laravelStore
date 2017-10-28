<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MyProfileController extends Controller
{
    public function updateMyProfile(User $user,Request $request){
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
	    }

	    return $this->jsonResponse(Auth::user());
    }
}
