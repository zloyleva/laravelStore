@extends('layouts.index')

@section('content')
    <div class="container">
        <h1>Контакты</h1>
    </div>
    <div class="container">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <p><b>Мы находимся по адресу:</b></p>
                <p>Запорожье, ул. Деповская 72</p>
                <p><b>Добраться к нам можно:</b></p>
                <ul>
                    <li>с Анголенко на трамвае № 10, 12, 14, 15</li>
                    <li>с Песков на маршрутке № 3, 37, 42</li>
                    <li>с Космоса на маршрутке № 9, 9а</li>
                    <li>с Иванова на трамвае № 3, 9а, 12, 13, 22, 25, 32, 37, 42, 44</li>
                    <li>с Иванова на маршрутке № 57, 60, 64 71а</li>
                </ul>
                <p><b>Телефоны:</b></p>
                <p>(061) 769 95 46</p>
                <p>(067) 618 05 45</p>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div id="map"></div>
            </div>
        </div>
    </div>
    <script>
        function initMap() {
            var uluru = {lat: 47.8189432, lng: 35.1994792};//47.8189432,35.1994792
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: uluru
            });
            var marker = new google.maps.Marker({
                position: uluru,
                map: map
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API')}}&callback=initMap&language=ru&region=UA"
            type="text/javascript"></script>
@stop