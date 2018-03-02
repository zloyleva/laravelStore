<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SlidersController extends Controller
{
    public function index(Slider $slider){

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

    public function edit(Request $request, Slider $slider){

//        dd($slider->where('id',$request->id)->get());
        return view('admin.sliderCreateNew', [
                'pageName'=>'Edit the Slide',
                'slider'=>$slider->where('id',$request->id)->first()
            ]
        );
    }
}
