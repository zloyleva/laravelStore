@extends('layouts.index')

@section('content')
<div class="container">
    <h1>Orders</h1>
</div>
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Status</th>
                <th>Total</th>
                <th>Note</th>
            </tr>
        </thead>

        <tbody>

          @foreach($orders as $order)
            <tr class="js-row" id="{{$order->id}}">
                <td>{{$order->id}} <a href="/orders/show/{{$order->id}}">Details</a></td>
                <td>{{$order->created_at}}</td>
                <td>{{$order->status}}</td>
                <td>{{$order->total}}</td>
                <td>{{$order->note}}</td>
            </tr>
          @endforeach

        </tbody>
    </table>
</div>
@stop
