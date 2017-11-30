<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;

class ManagersController extends Controller
{
    public function store(Request $request, Manager $manager){
        $manager->create($request->all());
    }
}
