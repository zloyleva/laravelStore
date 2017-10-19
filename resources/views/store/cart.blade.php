@extends('layouts.index')

@section('content')
        <div class="container page-name">
            <h1>Card</h1>
        </div>
    @if(count($productsInCart) > 0)
        <div class="container js-cart-content">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>SKU</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>

                @foreach($productsInCart as $row)

                    <tr class="js-row" data-id="{{$row->rowId}}" id="{{$row->rowId}}">
                        <td>{{$row->id}}</td>
                        <td>
                            <p><strong>{{$row->name}}</strong></p>
                        </td>
                        <td id="products_qty"><input class="products_quantity form-control" type="number" min="0" step="1"
                                   value="{{$row->qty}}"></td>
                        <td>$ {{$row->price}}</td>
                        <td>$ {{$row->total}}</td>
                        <td><button title="Remove product from cart" class="btn btn-danger js-remove-product">&times;</button></td>
                    </tr>

                @endforeach

                </tbody>

                <tfoot>
                <tr>
                    <td colspan="3">&nbsp;</td>
                    <td>Total</td>
                    <td id="cartTotal"><?php echo Cart::total(); ?></td>
                    <td></td>
                </tr>
                </tfoot>
            </table>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <form id="create-order-form" class="" action="{{route('orders.list')}}" method="get">
                        <input type="hidden" name="status" value="setOrder">
                        <div class="form-group">
                            <label>Enter address for delivery <sup class="alert-danger">*</sup></label>
                            <input id="address" name="address" type="text" class="form-control" value=""/>
                            {{--https://developers.google.com/places/web-service/policies--}}
                            <img src="https://developers.google.com/places/documentation/images/powered-by-google-on-white.png">
                        </div>
                        <div class="form-group">
                            <label>Enter your phone <sup class="alert-danger">*</sup></label>
                            <input class="form-control" type="phone" id="phone" name="phone" value=""
                                   placeholder="Enter your phone. Format (099)1234567">
                        </div>
                        <div class="form-group">
                            <label>Enter note</label>
                            <textarea class="form-control" id="note" name="note" rows="8" cols="80"
                                      placeholder="Enter address for delivery"></textarea>
                        </div>
                        <div class="form-group">
                            <input id="submitCart" class="btn btn-primary" type="button" value="Submit">
                            <input id="clearCart" class="btn btn-danger" type="button" value="Clear Cart">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="container js-cart-content">
            Your cart is empty
        </div>
    @endif
@stop
