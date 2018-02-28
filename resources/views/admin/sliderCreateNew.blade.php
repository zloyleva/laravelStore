@extends('layouts.index')

@section('content')
<div class="container usersList">
    <h1 data-page="add_user">{{$pageName}}</h1>
    <a href="{{route('admin.sliders.index')}}" class="btn btn-success">Back</a>
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12  col-lg-12">

            <form action="{{route('admin.sliders.store')}}" id="addUserForm" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="InputName">Name</label>
                    <input name="name" type="text" class="form-control" id="InputName" placeholder="Enter name" value="">
                </div>
                <div class="form-group">
                    <label for="InputFile">Select image file</label>
                    <input name="img_url" type="file" id="InputFile" placeholder="Select image file">
                </div>
                <div class="form-group">
                    <label><input name="show_status" type="checkbox" value="1"> Show slider status</label>
                </div>


                <div class="form-group">
                    <label for="InputButtonURL">Button link URL</label>
                    <input name="link_url" type="text" class="form-control" id="InputButtonURL" placeholder="Enter button link URL" value="">
                </div>
                <div class="form-group">
                    <label><input name="light_theme" type="checkbox" value="1"> Select light theme</label>
                </div>
                <div class="form-group">
                    <label for="InputSliderTitle">Slider title text</label>
                    <input name="text_title" type="text" class="form-control" id="InputSliderTitle" placeholder="Enter slider title text" value="">
                </div>
                <div class="form-group">
                    <label for="InputSliderContent">Slider title text</label>
                    <textarea name="text_content" id="InputSliderContent" class="form-control" rows="3" placeholder="Enter slider content text"></textarea>
                </div>
                <div class="form-group">
                    <label for="InputSliderButton">Slider button text</label>
                    <input name="text_button" type="text" class="form-control" id="InputSliderButton" placeholder="Enter slider button text" value="">
                </div>

                <div class="form-group">
                    <button id="addSlider" class="btn btn-primary">
                        {{ (isset($user))?'Update user':'Add user' }}
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@stop
