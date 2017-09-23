@extends('layouts.index')

@section('content')
<div class="container">
    <h1>Store</h1>
</div>
<div class="container">
    @foreach( $products as $product)
        <div id="{{$product->id}}" class="product_item col-sm-12 col-md-12 col-lg-12">
            <div class="row">
                <div class="col-sm-3 col-md-3 col-lg-3 section_thumbnail">
                    <img class="product_image" src="{{$product->image}}" alt="">
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 section_meta">
                    <h3 class="product_name">{{$product->name}}</h3>
                    <div class="product_category">Category: {{$product->category_id}}</div>
                    <div class="product_sku">Sku: {{$product->sku}}</div>
                    <div class="product_stock">Stock: {{$product->stock}}</div>
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3 section_buy">
                    <div class="product_price">${{$product->roundNumber($product->price)}}</div>
                    <div class="behavior_section">
                       <input class="products_quantity" type="number"  min="1" step="1" value="1">
                       <button class="btn btn-default">Add to cart</button>
                    </div>
                </div>
                
            </div>
        </div>
    @endforeach
    <div id="pagination_link" class="col-sm-12 col-md-12 col-lg-12">{{$products->links()}}</div>
</div>
@stop