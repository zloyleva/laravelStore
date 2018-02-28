@extends('layouts.index')

@section('content')
    <div class="container m-b-10">

        <div class="row">
            <div id="category_menu" class="col-sm-12 col-md-4 col-lg-4">
                <ul class="nav">
                    {!! $categories !!}
                </ul>
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8">
                <div class="row main_slider">
                    <ul class="main_slider_container">
                        @foreach($sliders as $slider)
                            <li class="slider_item"><img src="{{$slider->img_url}}" alt=""></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop