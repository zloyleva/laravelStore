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
                                @include('product.section.product-info', ['product'=>$product])
                                <div class="product_show"><a class="" href="/store/product/{{$product->slug}}">Подробнее о продукте</a></div>
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3 section_buy">
                                @include('product.section.section_buy', ['product'=>$product])
                            </div>
                        </div>
                    </div>
                @endforeach
                <div id="pagination_link" class="col-sm-12 col-md-12 col-lg-12">{{$products->appends($searchParams)->links()}}</div>
            </div>
        </div>

    </div>
@stop
