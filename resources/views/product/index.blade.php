@extends('layouts.index',$og)

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
                            @include('product.section.product-info', ['product'=>$product])

                            <div class="section_buy">
                                @include('product.section.section_buy', ['product'=>$product])
                            </div>

                            <div class="product_stock">Описание: {{$product->description}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
