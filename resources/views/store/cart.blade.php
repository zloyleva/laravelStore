@extends('layouts.index')

@section('content')
        <div class="container page-name">
            <h1>Корзина</h1>
        </div>
    @if(count($productsInCart) > 0)
        <div class="container js-cart-content">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Артикул</th>
                    <th>Название</th>
                    <th>Количество</th>
                    <th>Цена</th>
                    <th>Сумма</th>
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
                        <td id="products_qty"><button class="btn btn-danger js-sub-product">-</button><input class="products_quantity form-control" type="number" min="1" step="1"
                                   value="{{$row->qty}}" data-qty="{{$row->qty}}"><buttton class="btn btn-success js-add-product">+</buttton></td>
                        <td>{{$row->price}}</td>
                        <td class="js-item-total">{{$row->total}}</td>
                        <td><button title="Remove product from cart" class="btn btn-danger js-remove-product">&times;</button></td>
                    </tr>

                @endforeach

                </tbody>

                <tfoot>
                <tr>
                    <td colspan="3">&nbsp;</td>
                    <td>Итого</td>
                    <td id="cartTotal"><?php echo Cart::total(); ?> грн</td>
                    <td></td>
                </tr>
                </tfoot>
            </table>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <form id="create-order-form" class="" action="{{route('orders.list')}}" method="get">
                        <input type="hidden" name="status" value="setOrder">
                        <div class="form-group">
                            <label>Введите адресс доставки <sup>*</sup></label>
                            <input id="address" name="address" type="text" class="form-control" value="{{$user->address}}"/>
                            {{--https://developers.google.com/places/web-service/policies--}}
                            <img src="https://developers.google.com/places/documentation/images/powered-by-google-on-white.png">
                        </div>
                        <div class="form-group">
                            <label>Введите Ваш телефон(для связи) <sup>*</sup></label>
                            <input class="form-control" type="phone" id="phone" name="phone" value="{{$user->phone}}"
                                   placeholder="Телефон в формате (099)1234567">
                        </div>
                        <div class="form-group">
                            <label>Поле для особых пожеланий к заказу</label>
                            <textarea class="form-control" id="note" name="note" rows="8" cols="80"
                                      placeholder="Введите свои пожелания"></textarea>
                        </div>
                        <div class="form-group">
                            <input id="submitCart" class="btn btn-primary" type="button" value="Сделать заказ">
                            <input id="clearCart" class="btn btn-danger" type="button" value="Очистить корзину">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="container js-cart-content">
            Ваша козина пуста
        </div>
    @endif
@stop
