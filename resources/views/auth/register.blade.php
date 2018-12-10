@extends('layouts.index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Регистрация</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}" id="registerForm">
                            {{ csrf_field() }}


                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail*</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Пароль*</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Повторите пароль*</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                            </div>


                            <hr>


                            {{--<div class="form-group">--}}
                                {{--<div class="col-md-6 col-md-offset-4 select_user_type">--}}
                                    {{--<div class="radio_item">--}}
                                        {{--<input id="salesForSelf" type="radio" name="userType" value="Покупки для себя">--}}
                                        {{--<label for="salesForSelf">Покупки для себя</label>--}}
                                    {{--</div>--}}
                                    {{--<div class="radio_item">--}}
                                        {{--<input id="salesForUr" type="radio" name="userType" value="Юридическое лицо">--}}
                                        {{--<label for="salesForUr">Юридическое лицо</label>--}}
                                    {{--</div>--}}
                                    {{--<div class="radio_item">--}}
                                        {{--<input id="salesForOpt" type="radio" name="userType" value="Оптовый покупатель">--}}
                                        {{--<label for="salesForOpt">Оптовый покупатель</label>--}}
                                    {{--</div>--}}
                                    {{--<div id="insertErrorMessage"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
                                <label for="fname" class="col-md-4 control-label">ФИО</label>

                                <div class="col-md-6">
                                    <input id="fname" type="text" class="form-control" name="fname"
                                           value="{{ old('fname') }}" autofocus>

                                    @if ($errors->has('fname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">--}}
                                {{--<label for="name" class="col-md-4 control-label">Логин</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="name" type="text" class="form-control" name="name"--}}
                                           {{--value="{{ old('name') }}" >--}}

                                    {{--@if ($errors->has('name'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('name') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-4 control-label">Телефон*</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control" name="phone"
                                           value="{{ old('phone') }}" required>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-4 control-label">Адрес</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address"
                                           value="{{ old('address') }}" >

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--<div class="form-group">--}}
                                {{--<label for="comment" class="col-md-4 control-label">Коментарий</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<textarea class="form-control" name="comment" id="comment"--}}
                                              {{--rows="5">{{ old('comment') }}</textarea>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button id="registerBtn" type="button" class="btn btn-primary">
                                        Зарегистрироваться
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
