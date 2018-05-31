@extends('layouts.index')

@section('content')
    <div class="container usersList header_section">
        <h1 data-page="add_user">{{$pageName}}</h1>
        <a href="{{route('admin.sales.index')}}" class="btn btn-success">Back</a>
    </div>
    <div class="container form_container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12  col-lg-12">

                @include('layouts.flash_messages')

                <form action="{{ $action_url }}" id="addArrivalForm" method="post"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @isset($sale)
                        <input name="id" type="hidden" value="{{$sale->id}}">
                    @endisset
                    <div class="form-group">
                        <label for="InputRoznica">Ссылка на розничный прайс</label>
                        <input name="price_user" type="text" class="form-control" id="InputRoznica" placeholder="Ссылка на розничный прайс"
                               value="{{ $sale->price_user or '' }}" required>
                    </div>

                    <div class="form-group">
                        <label for="InputOprt3">Ссылка на опт #3 прайс</label>
                        <input name="price_3_opt" type="text" class="form-control" id="InputOprt3" placeholder="Ссылка на опт #3 прайс"
                               value="{{ $sale->price_3_opt or '' }}" required>
                    </div>

                    <div class="form-group">
                        <label for="InputOprt8">Ссылка на опт #8 прайс</label>
                        <input name="price_8_opt" type="text" class="form-control" id="InputOprt8" placeholder="Ссылка на опт #8 прайс"
                               value="{{ $sale->price_8_opt or '' }}" required>
                    </div>

                    <div class="form-group">
                        <label for="InputDealer">Ссылка на Диллер прайс</label>
                        <input name="price_dealer" type="text" class="form-control" id="InputDealer" placeholder="Ссылка на Диллер прайс"
                               value="{{ $sale->price_dealer or '' }}" required>
                    </div>

                    <div class="form-group">
                        <label for="InputVip">Ссылка на VIP прайс</label>
                        <input name="price_vip" type="text" class="form-control" id="InputVip" placeholder="Ссылка на VIP прайс"
                               value="{{ $sale->price_vip or '' }}" required>
                    </div>

                    <div class="form-group">
                        <label><input name="publish" type="checkbox" value="1"
                                      @if(isset($sale) && $sale->publish) checked @endif
                                      @if(!isset($sale)) checked @endif
                            > Show arrival status</label>
                    </div>

                    <div class="form-group">
                        <label for="InputArrivalDate">Выберети дату прихода</label>
                        <input name="sales_date" type="text" class="form-control" id="InputArrivalDate" placeholder="Выберети дату прихода"
                               value="{{ $sale->sales_date or '' }}" required>
                    </div>


                    <div class="form-group">
                        <button type="submit" id="addSlider" class="btn btn-primary">
                            {{ (isset($sale))?'Update':'Add' }} sale
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@stop
