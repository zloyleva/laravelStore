@extends('layouts.index')

@section('content')
    <div class="container usersList header_section">
        <h1 data-page="add_user">{{$pageName}}</h1>
        <a href="{{route('admin.arrival.index')}}" class="btn btn-success">Back</a>
    </div>
    <div class="container form_container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12  col-lg-12">

                <form action="{{ $action_url }}" id="addArrivalForm" method="post"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @isset($arrival)
                        <input name="id" type="hidden" value="{{$arrival->id}}">
                    @endisset
                    <div class="form-group">
                        <label for="InputRoznica">Ссылка на розничный прайс</label>
                        <input name="price_user" type="text" class="form-control" id="InputRoznica" placeholder="Ссылка на розничный прайс"
                               value="{{ $arrival->price_user or '' }}">
                    </div>

                    <div class="form-group">
                        <label for="InputOprt3">Ссылка на опт #3 прайс</label>
                        <input name="price_3_opt" type="text" class="form-control" id="InputOprt3" placeholder="Ссылка на опт #3 прайс"
                               value="{{ $arrival->price_3_opt or '' }}">
                    </div>

                    <div class="form-group">
                        <label for="InputOprt8">Ссылка на опт #8 прайс</label>
                        <input name="price_8_opt" type="text" class="form-control" id="InputOprt8" placeholder="Ссылка на опт #8 прайс"
                               value="{{ $arrival->price_8_opt or '' }}">
                    </div>

                    <div class="form-group">
                        <label for="InputDealer">Ссылка на Диллер прайс</label>
                        <input name="price_dealer" type="text" class="form-control" id="InputDealer" placeholder="Ссылка на Диллер прайс"
                               value="{{ $arrival->price_dealer or '' }}">
                    </div>

                    <div class="form-group">
                        <label for="InputVip">Ссылка на VIP прайс</label>
                        <input name="price_vip" type="text" class="form-control" id="InputVip" placeholder="Ссылка на VIP прайс"
                               value="{{ $arrival->price_vip or '' }}">
                    </div>

                    <div class="form-group">
                        <label><input name="publish" type="checkbox" value="1"
                                      @if(isset($arrival) && $arrival->publish) checked @endif
                                      @if(!isset($arrival)) checked @endif
                            > Show arrival status</label>
                    </div>

                    <div class="form-group">
                        <label for="InputArrivalDate">Выберети дату прихода</label>
                        <input name="arrival_date" type="text" class="form-control" id="InputArrivalDate" placeholder="Выберети дату прихода"
                               value="{{ $arrival->arrival_date or '' }}">
                    </div>


                    <div class="form-group">
                        <button id="addSlider" class="btn btn-primary">
                            {{ (isset($arrival))?'Update':'Add' }} arrival
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@stop
