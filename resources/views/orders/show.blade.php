@extends('layouts.index')

@section('content')
    <div class="container">
        <h1>Order</h1>
    </div>
    <div class="container">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <dl class="dl-horizontal">
                    <dt>Order #</dt>
                    <dd>{{$order->id}}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Status</dt>
                    <dd>{{$order->status}}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Created date</dt>
                    <dd>{{$order->created_at}}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Total</dt>
                    <dd>$ {{$order->total}}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Address</dt>
                    <dd>{{$order->address}}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Note</dt>
                    <dd>{{$order->note}}</dd>
                </dl>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($order->orderListItems as $row)

                        <tr data-row_id="{{$row->rowId}}">
                            <td>{{$row->sku}}</td>
                            <td>
                                <p><strong>{{$row->name}}</strong></p>
                            </td>
                            <td>{{$row->qty}}</td>
                            <td>$ {{$row->price}}</td>
                            <td>$ {{$row->total}}</td>
                        </tr>

                    @endforeach

                    </tbody>

                    <tfoot>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                        <td>Total</td>
                        <td>$ {{$order->total}}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
@stop
