@extends('layouts.index')

@section('content')
<div class="container usersList header_section">
    <h1>Список пользователей</h1>
    <div class="addUserSection">
        <a href="{{ route('admin.users.create')  }}" class="btn btn-primary">Добавить нового</a>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped admin-table">
                    <thead>
                        <tr>
                            <th class="js-column-order" data-column="id">id</th>
                            <th class="js-column-order" data-column="created_at">Дата регистрации</th>
                            <th class="js-column-order" data-column="flname">ФИО</th>
                            <th class="js-column-order" data-column="phone">Телефон</th>
                            <th class="js-column-order" data-column="email">Email</th>
                            <th class="js-column-order" data-column="address">Адрес</th>
                            <th class="js-column-order" data-column="company">Компания</th>
                            <th class="js-column-order" data-column="price_type">Тип цены</th>
                            <th class="js-column-order" data-column="manager_id">Менеджер</th>
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
                            <td class="js-created_at" data-row="{{$user->created_at}}">{{$user->created_at}}</td>
                            <td class="js-flname" data-row="{{$user->fname}} {{$user->lname}}">
                                {{$user->fname}}
                                {{$user->lname}}
                                (
                                @if($user->status == 1)
                                    <span style="color: green">Проверенный</span>
                                @else
                                    <span style="color: red">Новый</span>
                                @endif
                                )
                            </td>
                            <td class="js-phone" data-row="{{$user->phone}}">{{$user->phone}}</td>
                            <td class="js-email" data-row="{{$user->email}}">{{$user->email}}</td>
                            <td class="js-address" data-row="{{$user->address}}">{{$user->address}}</td>
                            <td class="js-company" data-row="{{$user->company}}">{{$user->company}}</td>
                            <td class="js-price_type" data-row="{{$user->price_type}}">{{$priceTypeList[$user->price_type-1]['description']}}</td>
                            <td class="js-manager_id" data-row="{{$user->manager->id}}">{{$user->manager->name}}</td>
                            <td><a class="btn btn-success" href="{{route('admin.users.index')}}/{{$user->id}}/edit">Редактировать</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
