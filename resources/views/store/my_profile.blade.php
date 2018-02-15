@extends('layouts.index')

@section('content')

    <div class="container">
        <h1>{{$pageName}}</h1>
    </div>
    <div class="container">

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h2>Ваши данные</h2>
                <form id="usersData" action="" class="form-horizontal">
                    <div class="form-group">
                        <label for="userName" class="col-sm-2 control-label">Логин</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="userName" name="name" value="{{ old('name')??$user->name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="userFirstName" class="col-sm-2 control-label">Имя</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="userFirstName" name="fname" value="{{ old('fname')??$user->fname }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="userLastName" class="col-sm-2 control-label">Фамилия</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="userLastName" name="lname" value="{{ old('lname')??$user->lname }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="userEmail" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="userEmail" placeholder="{{$user->email}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="userEmail" class="col-sm-2 control-label">Тип цены</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="userEmail" placeholder="{{$price_type_desc->description}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="userAddress" class="col-sm-2 control-label">Адрес доставки</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address')??$user->address }}">
                            {{--https://developers.google.com/places/web-service/policies--}}
                            <img src="https://developers.google.com/places/documentation/images/powered-by-google-on-white.png">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="userPhone" class="col-sm-2 control-label">Телефон для связи</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="userPhone" name="phone" value="{{ old('phone')??$user->phone }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Обновить данные</button>
                    </div>
                </form>
                <h2>Сменить пароль</h2>
                <form id="usersPassword" action="" class="form-horizontal">
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">Новый пароль</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" placeholder="Введите Ваш новый пароль" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="passwordConfirmation" class="col-sm-2 control-label">Подтвердите новый пароль</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="passwordConfirmation" placeholder="Подтвердите Ваш новый пароль" name="password_confirmation">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Сменить пароль</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@stop
