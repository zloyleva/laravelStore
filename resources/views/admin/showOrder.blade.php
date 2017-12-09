@extends('layouts.index')

@section('content')
    <div class="container">
        <h1>Детали заказа</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h4>Клиент</h4>
                <dl class="dl-horizontal">
                    <dt>Имя Фамилия</dt>
                    <dd>{{$order->user->fname}} {{$order->user->fname}}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Логин</dt>
                    <dd>{{$order->user->name}}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Email</dt>
                    <dd>{{$order->user->email}}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Phone</dt>
                    <dd>{{$order->user->phone}}</dd>
                </dl>
                <hr>
            </div>
        </div>
    </div>

    @include('orders.orderMainTemplate', ['order'=>$order])

@stop