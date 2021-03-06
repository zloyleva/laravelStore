@extends('layouts.index')

@section('content')
<div class="container usersList header_section">
    <h1>Users list</h1>
    <div class="addUserSection">
        <a href="{{ route('admin.users.create')  }}" class="btn btn-primary">Add new User</a>
    </div>
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
                            <th class="js-column-order" data-column="price_type">Price type</th>
                            <th class="js-column-order" data-column="client_type">Client type</th>
                            <th class="js-column-order" data-column="manager_id">Manager</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        {{-- Hide admins --}}
                        @if( ($user->role == 'admin' || $user->role == 'manager') && Auth::user()->role != 'admin' )
                            @continue
                        @endif
                        <tr class="js-row user-item" data-id="{{$user->id}}">
                            <td class="js-id" data-row="{{$user->id}}">{{$user->id}}</td>
                            <td class="js-flname"
                                data-row="{{$user->fname}} {{$user->lname}}">{{$user->fname}} {{$user->lname}}</td>
                            <td class="js-name" data-row="{{$user->name}}">{{$user->name}}</td>
                            <td class="js-email" data-row="{{$user->email}}">{{$user->email}}</td>

                            <td class="js-price_type" data-row="{{$user->price_type}}">{{$priceTypeList[$user->price_type-1]['description']}}</td>

                            <td class="js-client_type" data-row="{{$user->client_type}}">{{$user->client_type}}</td>
                            <td class="js-manager_id" data-row="{{$user->manager->id}}">{{$user->manager->name}}</td>
                            <td><a href="{{route('admin.users.index')}}/{{$user->id}}/edit">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
