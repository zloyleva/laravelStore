@extends('layouts.index')

@section('content')

    <div class="container">
        <h1>{{$pageName}}</h1>
    </div>
    <div class="container">

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h2>User data</h2>
                <form id="usersData" action="" class="form-horizontal">
                    <div class="form-group">
                        <label for="userName" class="col-sm-2 control-label">Your login</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="userName" placeholder="{{$user->name}}" name="name" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="userFirstName" class="col-sm-2 control-label">Your first name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="userFirstName" placeholder="{{$user->fname}}" name="fname" value="{{ old('fname') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="userLastName" class="col-sm-2 control-label">Your last name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="userLastName" placeholder="{{$user->lname}}" name="lname" value="{{ old('lname') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="userEmail" class="col-sm-2 control-label">Your Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="userEmail" placeholder="{{$user->email}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="userEmail" class="col-sm-2 control-label">Your price type</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="userEmail" placeholder="{{$price_type_desc->description}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="userAddress" class="col-sm-2 control-label">Your address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="address" placeholder="{{$user->address}}" name="address" value="{{ old('address') }}">
                            {{--https://developers.google.com/places/web-service/policies--}}
                            <img src="https://developers.google.com/places/documentation/images/powered-by-google-on-white.png">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="userPhone" class="col-sm-2 control-label">Your phone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="userPhone" placeholder="{{$user->phone}}" name="phone" value="{{ old('phone') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
                <h2>Change your password</h2>
                <form id="usersPassword" action="" class="form-horizontal">
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">Your password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" placeholder="Enter your new password" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="passwordConfirmation" class="col-sm-2 control-label">Confirm Your password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="passwordConfirmation" placeholder="Confirm your new password" name="password_confirmation">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Change password</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@stop
