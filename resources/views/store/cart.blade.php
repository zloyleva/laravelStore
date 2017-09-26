@extends('layouts.index')

@section('content')
<div class="container">
    <h1>Card</h1>
</div>
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>

        <tbody>

            @foreach($productsInCart as $row)

                <tr data-row_id="{{$row->rowId}}">
                    <td></td>
                    <td>
                        <p><strong>{{$row->name}}</strong></p>
                    </td>
                    <td><input class="products_quantity" type="number"  min="0" step="1" value="{{$row->qty}}"></td>
                    <td>$ {{$row->price}}</td>
                    <td>$ {{$row->total}}</td>
                </tr>

            @endforeach

        </tbody>
        
        <tfoot>
            <tr>
                <td colspan="3">&nbsp;</td>
                <td>Total</td>
                <td><?php echo Cart::total(); ?></td>
            </tr>
        </tfoot>
    </table>
</div>
@stop