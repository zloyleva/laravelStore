<form action="" class="addProductToCart">
    <input type="hidden" name="productId" value="{{$product->id}}">
    <div class=" {{(Auth::check() && Auth::user()->price_type != 1)?'text-line-through ':'product_price'}}"
         data-price_user="{{$product->price_user}}">
        {{$product->roundNumber($product->price_user)}} грн
    </div>
    @if(Auth::check() && Auth::user()->price_type != 1 )
        <div class="product_price"
             data-price_type="{{$price_type =   $priceTypeList[Auth::user()->price_type-1]['type']}}">
            {{$product->roundNumber($product->$price_type)}} грн
        </div>
    @endif
    <div class="behavior_section">
        <input name="qty" class="products_quantity" type="number" min="1" step="1" value="1">
        <button class="btn btn-default js-add_to_cart" type="button">В корзину</button>
    </div>
</form>