@extends('layouts.index')

@section('content')
    <div class="container page-name">
        <h1>Корзина</h1>
    </div>

    @if(count($productsInCart) > 0)
        <div class="container js-cart-content">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <div class="table-content">
                        <div class="table-header table-row-cart">
                            <div class="td-item">#</div>
                            <div class="td-sku">Артикул</div>
                            <div class="td-name">Название</div>
                            <div class="td-qty">
                                <span class="show-big">Количество</span>
                                <span class="show-small hidden">Кол-во</span>
                            </div>
                            <div class="td-price">Цена</div>
                            <div class="td-sum">Сумма</div>
                            <div class="td-action"></div>
                        </div>
                        @foreach($productsInCart as $row)
                            <div class="table-row-cart table-item">
                                <form action="" class="js-item-form">
                                    <input type="hidden" name="rowId" value="{{$row->rowId}}">
                                    @if(isset($_COOKIE['user_ids']))
                                        <input type="hidden" name="user_ids" value="{{$_COOKIE['user_ids']}}">
                                    @endif
                                    <div class="td-item">{{$loop->iteration}}</div>
                                    <div class="td-sku">{{$row->id}}</div>
                                    <div class="td-name">{{$row->name}}</div>
                                    <div class="td-qty">
                                        <span class="js-sub-product controls-item">-</span>
                                        <input name="amount" class="products_quantity form-control" type="number" min="1" step="1"
                                               value="{{$row->qty}}" data-qty="{{$row->qty}}">
                                        <span class="js-add-product controls-item">+</span>
                                    </div>
                                    <div class="td-price">{{round($row->price, 2)}}</div>
                                    <div class="td-sum">{{round($row->total, 2)}}</div>
                                    <div class="td-action">
                                        <span title="Remove product from cart" class="js-remove-product controls-item">&times;</span>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                        <div class="table-footer table-row-cart">
                            <div class="td-item"></div>
                            <div class="td-sku"></div>
                            <div class="td-name"></div>
                            <div class="td-qty"></div>
                            <div class="td-price">Итого</div>
                            <div class="td-sum" id="cartTotal" data-total_sum="{{$totalSum}}">{{$totalSum}} грн</div>
                            <div class="td-action"></div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <form id="create-order-form" class="" action="{{route('orders.list')}}" method="get">
                        <input type="hidden" name="status" value="setOrder">
                        @if(isset($_COOKIE['user_ids']))
                            <input type="hidden" name="user_ids" value="{{$_COOKIE['user_ids']}}">
                        @endif
                        <div class="form-group">
                            <label>Введите адресс доставки <sup>*</sup></label>
                            <input id="address" name="address" type="text" class="form-control" value="{{$user->address or ''}}" placeholder="Введите адресс доставки"/>
                            {{--https://developers.google.com/places/web-service/policies--}}
                            <img src="https://developers.google.com/places/documentation/images/powered-by-google-on-white.png">
                        </div>
                        <div class="form-group">
                            <label>Введите Ваш телефон(для связи) <sup>*</sup></label>
                            <input class="form-control" type="phone" id="phone" name="phone" value="{{$user->phone or ''}}"
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

        <!-- Modal -->
        <div class="fade modal" id="loadToCreateOrder">
            <div class="content-block">
                <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>Создаем заказ...
            </div>
        </div>
    @else
        <div class="container js-cart-content">
            <div class="row empty-cart">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    Ваша козина пуста
                </div>
            </div>
        </div>
    @endif
@stop
