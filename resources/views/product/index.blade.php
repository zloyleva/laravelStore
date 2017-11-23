@extends('layouts.index')

@section('content')

    <div class="container">
        <h1></h1>
    </div>
    <div class="container">

        <div class="row">
            <div id="category_menu" class="col-sm-12 col-md-4 col-lg-4">
                <ul class="nav">
                    {!! $categories !!}
                </ul>
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8">
                <div id="{{$product->id}}" class="js-row product_item ">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 section_thumbnail">
                            <img class="product_image" src="{{$product->image}}" alt="">
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 section_meta">
                            <h3 class="product_name">{{$product->name}}</h3>
                            <div class="product_category">Category: {{$product->category->name}}</div>
                            <div class="product_sku">Sku: {{$product->sku}}</div>
                            <div class="product_stock">Stock: {{$product->stock}}</div>

                            <div class="section_buy">
                                <div class=" {{(Auth::check() && Auth::user()->role != 'user')?'text-line-through ':'product_price'}}"
                                     data-price_user="{{$product->price_user}}">
                                    $ {{$product->roundNumber($product->price_user)}}
                                </div>
                                @if(Auth::check() && Auth::user()->role != 'user' )
                                    {{Auth::user()->role}}
                                    <div class="product_price"
                                         data-price_type="{{$price_type = Auth::user()->price_type}}">
                                        $ {{$product->roundNumber($product->$price_type)}}
                                    </div>
                                @endif
                                <div class="behavior_section">
                                    <input class="products_quantity" type="number" min="1" step="1" value="1">
                                    <button class="btn btn-default js-add_to_cart">Add to cart</button>
                                </div>
                            </div>

                            <div class="product_stock">Description: {{$product->description}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
