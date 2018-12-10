@extends('layouts.index')

@section('content')
    <div class="container usersList">
        <h1 data-page="add_user">
            @if(isset($user))
                Редактировать пользователя
            @else
                Создать пользователя
            @endif
        </h1>
        <a href="{{route('admin.users.index')}}" class="btn btn-success">Назад</a>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <form action="" id="addUserForm">
                    {{ csrf_field() }}
                    <input type="hidden" id="user_id" name="user_id" value="{{ $user->id or ''  }}">
                    <div class="form-group">
                        <label for="InputName">Логин</label>
                        <input name="name" type="text" class="form-control" id="InputName" placeholder="Логин" value="{{ $user->name or ''  }}">
                    </div>
                    <div class="form-group">
                        <label for="InputFName">Имя</label>
                        <input name="fname" type="text" class="form-control" id="InputFName" placeholder="Имя" value="{{ $user->fname or ''  }}">
                    </div>
                    <div class="form-group">
                        <label for="InputLName">Фамилия</label>
                        <input name="lname" type="text" class="form-control" id="InputLName" placeholder="Фамилия" value="{{ $user->lname or ''  }}">
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
                        <label for="InputPassword">Пароль</label>
                        <input name="password" type="text" class="form-control" id="InputPassword" placeholder="Пароль">
                    </div>
                    <div class="form-group {{ ( Auth::user()->isManager() )?'hidden':'' }}">
                        <label for="InputRole">Роль</label>
                        <select name="role" class="form-control" id="InputRole" >
                            @foreach($roles as $role)
                                <option value="{{$role}}" {{ (isset($user) && $user->role == $role)?'selected':'' }}>
                                    {{$role}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="InputPrice">Тип цены</label>
                        <select name="price_type" class="form-control" id="InputPrice">
                            @foreach($priceTypeList as $item)
                                <option value="{{$item->id}}" {{ (isset($user) && $user->price_type == $item->id)?'selected':'' }}>
                                    {{$item->description}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="InputAddress">Адрес</label>
                        <input id="InputAddress" name="address" type="text" class="form-control" placeholder="Адрес" value="{{ $user->address or ''  }}"/>
                        {{--https://developers.google.com/places/web-service/policies--}}
                        {{--<img src="https://developers.google.com/places/documentation/images/powered-by-google-on-white.png">--}}
                    </div>

                    <div class="form-group">
                        <label for="InputСompany">Компания</label>
                        <input id="InputСompany" name="company" type="text" class="form-control" placeholder="Компания" value="{{ $user->company or ''  }}"/>
                    </div>

                    <div class="form-group">
                        <label for="InputStatus">Статус</label>
                        <select name="status" class="form-control" id="InputStatus">
                            <option value="0">Не проверенный</option>
                            <option value="1" {{ (isset($user) && $user->status == 1) ? 'selected' : '' }}>Проверенный</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="InputPhone">Телефон</label>
                        <input name="phone" type="tel" class="form-control" id="InputPhone" placeholder="Введите номер" value="{{ $user->phone or ''  }}">
                    </div>
                    <div class="form-group">
                        <label for="InputPrice">Менеджер</label>
                        <select name="manager_id" class="form-control" id="InputPrice">
                            @foreach($managerList as $manager)
                                <option value="{{$manager->id}}" {{ (isset($user) && $user->manager_id == $manager->id) ? 'selected' : '' }}>
                                    {{$manager->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button id="addUser" class="btn btn-primary">
                            {{ (isset($user)) ? 'Обновить' : 'Добавить' }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@stop
