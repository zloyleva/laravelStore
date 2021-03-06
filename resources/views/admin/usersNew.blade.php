@extends('layouts.index')

@section('content')
<div class="container usersList">
    <h1 data-page="add_user">
        @if(isset($user))
            Edit user
        @else
            Add new user
        @endif
    </h1>
    <a href="{{route('admin.users.index')}}" class="btn btn-success">Back</a>
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6  col-lg-6">

            <form action="" id="addUserForm">
                {{ csrf_field() }}
                <input type="hidden" id="user_id" name="user_id" value="{{ $user->id or ''  }}">
                <div class="form-group">
                    <label for="InputName">Name</label>
                    <input name="name" type="text" class="form-control" id="InputName" placeholder="Enter name" value="{{ $user->name or ''  }}">
                </div>
                <div class="form-group">
                    <label for="InputFName">First name</label>
                    <input name="fname" type="text" class="form-control" id="InputFName" placeholder="Enter first name" value="{{ $user->fname or ''  }}">
                </div>
                <div class="form-group">
                    <label for="InputLName">Last name</label>
                    <input name="lname" type="text" class="form-control" id="InputLName" placeholder="Enter last name" value="{{ $user->lname or ''  }}">
                </div>
                <div class="form-group ">
                    <label for="InputEmail">Email</label>
                    <input name="email" type="email" class="form-control {{ (isset($user) && Auth::user()->isManager() )?'hidden':'' }}"
                           id="InputEmail" placeholder="Enter email" value="{{ $user->email or ''  }}">
                    @if( isset($user) && Auth::user()->isManager() )
                        <p>{{ $user->email or ''  }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="InputPassword">Password</label>
                    <input name="password" type="text" class="form-control" id="InputPassword" placeholder="Enter password">
                </div>
                <div class="form-group {{ ( Auth::user()->isManager() )?'hidden':'' }}">
                    <label for="InputRole">Role</label>
                    <select name="role" class="form-control" id="InputRole" >
                        @foreach($roles as $role)
                            <option value="{{$role}}" {{ (isset($user) && $user->role == $role)?'selected':'' }}>
                                {{$role}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="InputPrice">Price type</label>
                    <select name="price_type" class="form-control" id="InputPrice">
                        @foreach($priceTypeList as $item)
                            <option value="{{$item->id}}" {{ (isset($user) && $user->price_type == $item->id)?'selected':'' }}>
                                {{$item->description}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="InputAddress">Address</label>
                    <input id="InputAddress" name="address" type="text" class="form-control" placeholder="Enter address" value="{{ $user->address or ''  }}"/>
                    {{--https://developers.google.com/places/web-service/policies--}}
                    <img src="https://developers.google.com/places/documentation/images/powered-by-google-on-white.png">
                </div>
                <div class="form-group">
                    <label for="InputPhone">Phone</label>
                    <input name="phone" type="tel" class="form-control" id="InputPhone" placeholder="Enter phone" value="{{ $user->phone or ''  }}">
                </div>
                <div class="form-group">
                    <label for="InputPrice">Manager</label>
                    <select name="manager_id" class="form-control" id="InputPrice">
                        @foreach($managerList as $manager)
                            <option value="{{$manager->id}}" {{ (isset($user) && $user->manager_id == $manager->id)?'selected':'' }}>
                                {{$manager->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button id="addUser" class="btn btn-primary">
                        {{ (isset($user))?'Update user':'Add user' }}
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@stop
