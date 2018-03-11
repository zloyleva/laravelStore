<?php

namespace App\Http\Controllers;

use App\Models\ArrivalGoods;
use Illuminate\Http\Request;

class ArrivalGoodsController extends Controller
{
    public function index(ArrivalGoods $arrivalGoods){
        return view('admin.listArrivalGoods',[
            'pageName'=>'Arrival of Goods',
            'arrivals'=>$arrivalGoods->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function store(Request $request, ArrivalGoods $arrivalGoods){
        $arrivalGoods->addNewArrival($request->all());
        return redirect(route('admin.arrival.index'));
    }

    public function create(){
        return view('admin.createArrivalGoods', [
                'pageName'=>'Create new Arrival',
                'action_url'=>route('admin.arrival.index'),
            ]
        );
    }

    public function edit(Request $request, ArrivalGoods $arrivalGoods){
        return view('admin.createArrivalGoods', [
                'pageName'=>'Edit the Arrival',
                'action_url'=>route('admin.arrival.index')."/".$request->id,
                'arrival'=>$arrivalGoods->where('id',$request->id)->first()
            ]
        );
    }

    public function update(Request $request, ArrivalGoods $arrivalGoods){

        $arrivalGoods->updateArrival($request->all());
        return redirect(route('admin.arrival.index'));
    }
}
