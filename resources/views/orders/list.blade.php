@extends('layouts.index')

@section('content')
<div class="container">
    <h1>Ваши заказы</h1>
</div>
<div class="container">
    @if( count($orders) > 0 )
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Дата</th>
                <th>Статус</th>
                <th>Сумма</th>
                <th></th>
            </tr>
        </thead>

        <tbody>

          @foreach($orders as $order)
            <tr class="js-row" id="{{$order->id}}">
                <td>{{$order->id}}</td>
                <td>{{$order->created_at}}</td>
                <td>{{$order->status}}</td>
                <td>{{$order->total}}</td>
                <td><a href="/orders/show/{{$order->id}}"><i class="fa fa-files-o" aria-hidden="true"></i> Показать детали заказа</a></td>
            </tr>
          @endforeach

        </tbody>
    </table>
    @else
        <div>
            У Вас нет еще заказов
        </div>
    @endif
</div>
@stop
