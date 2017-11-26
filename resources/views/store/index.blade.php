@extends('layouts.index')

@section('content')

    @include('layouts.search-product-form')

    <div class="container">
        <h1>{{$pageName}}</h1>
    </div>
    <div class="container">

        @include('layouts.breadcrumbs')

        <div class="row">
            <div id="category_menu" class="col-sm-12 col-md-4 col-lg-4">
                <ul class="nav">
                    {!! $categories !!}
                </ul>
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8">
                @foreach( $products as $product)
                    <div id="{{$product->id}}" class="js-row product_item ">
                        <div class="row">
                            <div class="col-sm-3 col-md-3 col-lg-3 section_thumbnail">
                                <img class="product_image" src="{{$product->image}}" alt="">
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 section_meta">
                                <h3 class="product_name">
                                    <a class="" href="/store/product/{{$product->slug}}">{{$product->name}}</a>
                                </h3>
                                <div class="product_category">Категория: {{$product->category->name}}</div>
                                <div class="product_sku">Артикул: {{$product->sku}}</div>
                                <div class="product_stock">Количество: {{$product->stock}}</div>
                                <div class="product_show"><a class="" href="/store/product/{{$product->slug}}">Подробнее о продукте</a></div>
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3 section_buy">
                                <div class=" {{(Auth::check() && Auth::user()->role != 'user')?'text-line-through ':'product_price'}}"
                                     data-price_user="{{$product->price_user}}">
                                    {{$product->roundNumber($product->price_user)}} грн
                                </div>
                                @if(Auth::check() && Auth::user()->role != 'user' )
                                    <div class="product_price"
                                         data-price_type="{{$price_type = Auth::user()->price_type}}">
                                        {{$product->roundNumber($product->$price_type)}} грн
                                    </div>
                                @endif
                                <div class="behavior_section">
                                    <input class="products_quantity" type="number" min="1" step="1" value="1">
                                    <button class="btn btn-default js-add_to_cart">В корзину</button>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
                <div id="pagination_link" class="col-sm-12 col-md-12 col-lg-12">{{$products->appends($searchParams)->links()}}</div>
            </div>
        </div>

    </div>
@stop
