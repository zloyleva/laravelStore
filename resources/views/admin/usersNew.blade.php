@extends('layouts.index')

@section('content')
<div class="container usersList">
    <h1 data-page="add_user">Add new user</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6  col-lg-6">

            <form action="" id="addUserForm">
                <div class="form-group">
                    <label for="InputName">Name</label>
                    <input name="name" type="text" class="form-control" id="InputName" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="InputFName">First name</label>
                    <input name="fname" type="text" class="form-control" id="InputFName" placeholder="Enter first name">
                </div>
                <div class="form-group">
                    <label for="InputLName">Last name</label>
                    <input name="lname" type="text" class="form-control" id="InputLName" placeholder="Enter last name">
                </div>
                <div class="form-group">
                    <label for="InputEmail">Email</label>
                    <input name="email" type="email" class="form-control" id="InputEmail" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="InputPassword">Password</label>
                    <input name="password" type="text" class="form-control" id="InputPassword" placeholder="Enter password">
                </div>
                <div class="form-group">
                    <label for="InputRole">Role</label>
                    <select name="role" class="form-control" id="InputRole" disabled>
                        <option value="buyer" selected>buyer</option>
                        <option value="manager">manager</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="InputPrice">Price type</label>
                    <select name="price_type" class="form-control" id="InputPrice">
                        @foreach($priceTypeList as $item)
                            <option value="{{$item->id}}">{{$item->description}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="InputAddress">Address</label>
                    <input id="InputAddress" name="address" type="text" class="form-control" placeholder="Enter address"/>
                    {{--https://developers.google.com/places/web-service/policies--}}
                    <img src="https://developers.google.com/places/documentation/images/powered-by-google-on-white.png">
                </div>
                <div class="form-group">
                    <label for="InputPhone">Phone</label>
                    <input name="phone" type="tel" class="form-control" id="InputPhone" placeholder="Enter phone">
                </div>
                <div class="form-group">
                    <label for="InputPrice">Manager</label>
                    <select name="manager_id" class="form-control" id="InputPrice">
                        @foreach($managerList as $manager)
                            <option value="{{$manager->id}}">{{$manager->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button id="addUser" class="btn btn-primary">Add user</button>
                </div>
            </form>

        </div>
    </div>
</div>
@stop
