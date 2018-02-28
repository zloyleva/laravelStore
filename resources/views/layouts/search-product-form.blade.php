<div class="container js-search-product">
    <div class="row">
        <form id="js-searchProductForm"  action="{{route('store')}}" method="get">
            <div class="col-sm-12 col-md-4 col-lg-4 search-property">
                <label for="">Поиск по: </label>
                {{--<select class="form-control"  name="inputData" id="inputData">--}}
                    {{--<option value="name">Названию</option>--}}
                    {{--<option value="sku">Артикулу</option>--}}
                {{--</select>--}}

                <label>
                    <input type="radio" name="inputData" id="optionsRadios1" value="name" @if($name_checked) checked @endif>
                    Названию
                </label>
                <label>
                    <input type="radio" name="inputData" id="optionsRadios2" value="sku" @if($sku_checked) checked @endif>
                    Артикулу
                </label>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 search-input">
                <input id="inputName" name="name" type="text" class="form-control" placeholder="Введите название">
            </div>
            <div class="col-sm-12 col-md-2 col-lg-2 search-button">
                <button type="submit" class="btn btn-default btn-search">Поиск</button>
            </div>
        </form>
    </div>
</div>