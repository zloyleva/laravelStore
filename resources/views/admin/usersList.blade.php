@extends('layouts.index')

@section('content')
<div class="container">
    <h1>Users list</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12  col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped admin-table">
                    <thead>
                        <tr>
                            <th class="js-column-order" data-column="id">User id</th>
                            <th class="js-column-order" data-column="flname">User first, last name</th>
                            <th class="js-column-order" data-column="name">Username</th>
                            <th class="js-column-order" data-column="email">Email</th>
                            <th class="js-column-order" data-column="status">Role</th>
                            <th class="js-column-order" data-column="status">Price type</th>
                            <th class="js-column-order" data-column="status">Phone</th>
                            <th class="js-column-order" data-column="status">Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr class="js-row" data-id="{{$user->id}}">
                            <td class="js-id" data-row="{{$user->id}}">{{$user->id}}</td>
                            <td class="js-flname"
                                data-row="{{$user->fname}} {{$user->lname}}">{{$user->fname}} {{$user->lname}}</td>
                            <td class="js-name" data-row="{{$user->name}}">{{$user->name}}</td>
                            <td class="js-email" data-row="{{$user->email}}">{{$user->email}}</td>
                            <td class="js-role" data-row="{{$user->role}}">{{$user->role}}</td>
                            <td class="js-price_type" data-row="{{$user->price_type}}">{{$user->price_type}}</td>
                            <td class="js-phone" data-row="{{$user->phone}}">{{$user->phone}}</td>
                            <td class="js-address" data-row="{{$user->address}}">{{$user->address}}</td>
                            <td>
                                <div class="form-group select-block">
                                    <select class="js-action form-control">
                                        <option hidden>Action</option>
                                        <option>Activate</option>
                                        <option>Deactivate</option>
                                        <option value="admin">Set as administrator</option>
                                        <option value="user">Set as user</option>
                                    </select>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
