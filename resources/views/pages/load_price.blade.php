@extends('layouts.index')

@section('content')
    <div class="container">
        <h1>Скачать прайс с последними поступлениями</h1>
    </div>
    <div class="container m-b-10">

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">

                <h3>Ваш тип цены:</h3>
                <p>{{$title}}</p>
                <a href="{{$link}}" target="_blank"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Скачать Excel прайс поледних поступлений товаров</a>

            </div>
        </div>
    </div>
@stop