@extends('layouts.index')

@section('content')
    <div class="container">
        <h1>Детали заказа</h1>
    </div>

    @include('orders.orderMainTemplate', ['order'=>$order])

@stop
