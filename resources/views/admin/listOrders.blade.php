@extends('layouts.index')

@section('content')
    <div class="container">
        <h1>Список заказов</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped admin-table">
                        <thead>
                        <tr>
                            <th class="js-column-order" data-column="id">ID</th>
                            <th class="js-column-order" data-column="created_at">Дата</th>
                            <th class="js-column-order" data-column="mail">Почта</th>
                            <th class="js-column-order" data-column="name">ФИО</th>
                            <th class="js-column-order" data-column="phone">Телефон</th>
                            <th class="js-column-order" data-column="address">Адрес</th>
                            <th class="js-column-order" data-column="company">Компания</th>
                            <th class="js-column-order" data-column="manager">Менеджер</th>
                            <th class="js-column-order" data-column="price_type">Тип цены</th>
                            <th class="js-column-order" data-column="total">Всего</th>
                            <th class="js-column-order"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($orderList as $item)
                            <tr>
                                <td data-id="{{$item->id}}">{{$item->id}}</td>
                                <td data-created_at="{{$item->created_at}}">{{$item->created_at}}</td>
                                <td data-mail="{{$item->email}}">{{$item->email ?? "Незарегистрированный"}}</td>
                                <td data-name="{{$item->fname}}">{{$item->fname}} {{$item->lname}}</td>
                                <td data-phone="{{$item->phone}}">{{$item->phone}}</td>
                                <td data-address="{{$item->address}}">{{$item->address}}</td>
                                <td data-company="{{$item->company}}">{{$item->company}}</td>
                                <td data-manager="{{$item->manager}}">{{$item->manager ?? "Неуказан"}}</td>
                                <td data-price_type="{{$item->price_type}}">{{$item->description ?? "Розничная"}}</td>
                                <td data-total="{{$item->total}}">{{$item->total}}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-success" href="/admin/orders/{{$item->id}}">Детали</a>
                                        <a class="btn btn-danger" href="/admin/orders/{{$item->id}}/print">Отправить в 1С</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="pagination_link" class="col-sm-12 col-md-12 col-lg-12">{{$orderList->links()}}</div>
        </div>
    </div>
@stop
