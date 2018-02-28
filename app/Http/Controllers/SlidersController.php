<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SlidersController extends Controller
{
    public function index(Slider $slider){

//        dd($slider->all()->toArray());
        return view('admin.listSliders', [
                'pageName'=>'Slides list',
                'slidersList'=>$slider->all(),
            ]
        );
    }

    public function store(Request $request, Slider $slider){

        $path = $request->file('img_url')->move('images_slides',$request->file('img_url')->getClientOriginalName());
        $slider->addNewSlider($request->all(),$path);
        return redirect(route('admin.sliders.index'));
    }

    public function create(){
        return view('admin.sliderCreateNew', [
                'pageName'=>'Create new Slide',
            ]
        );
    }
}
