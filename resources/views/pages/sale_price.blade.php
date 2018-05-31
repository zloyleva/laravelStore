@extends('layouts.index')

@section('content')
    <div class="container">
        <h1>{{$pageName}}</h1>
    </div>
    <div class="container m-b-10 arrival_goods">

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">

                <h3>Ваш тип цены: {{$title}}</h3>

                @forelse($sales as $sale)
                    <div class="arrival_item">
                        <h4>{{$sale->arrival_date}}</h4>
                        <a href="{{$sale->$price_type}}" target="_blank"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Скачать Excel файл с акцией на товары, за {{$sale->sales_date}}</a>
                    </div>
                @empty
                    <p>Нет приходов товара</p>
                @endforelse
            </div>
        </div>
    </div>
@stop