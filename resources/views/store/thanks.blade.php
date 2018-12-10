@extends('layouts.index')

@section('content')
    <div class="container page-name text-center">
        <h1>Спасибо!</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                Ваш заказ оформлен, в ближайшее время с Вами свяжутся!
            </div>
        </div>
    </div>

    <br>
    <br>
    <br>

    <script>

        document.addEventListener('DOMContentLoaded', function(){

            setTimeout( window.location.replace("/store") , 1000);
        });

    </script>


@endsection
