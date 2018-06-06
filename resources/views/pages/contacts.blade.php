@extends('layouts.index')

@section('content')
    <div class="container">
        <h1>Контакты</h1>
    </div>
    <div class="container">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <h4><b>Мы находимся по адресу:</b></h4>
                <p>Запорожье, ул. Деповская 72</p>
                <hr/>

                <h4><b>График работы супермаркета:</b></h4>
                <p>понедельник - суббота 9:00 - 19:00</p>
                <p>воскресенье 9:00- 17:00</p>
                <hr/>

                <h4><b>График работы одела продаж:</b></h4>
                <p>понедельник - пятница 9:00 - 18:00</p>
                <hr/>

                <h4><b>Добраться к нам можно:</b></h4>
                <ul>
                    <li>трамвай № 10, 12, 14, 15 - остановка Парк Климова</li>
                    <li>маршрутное такси  № 3, 37, 42, 9, 9а, 22, 25, 57, 13, 32, 64,42  - остановка Парк Климова</li>
                </ul>
                <hr/>
                
                <h4><b>Телефоны:</b></h4>
                <p>Секретарь (061)769-95-46</p>
                <p>Администратор (067)618-05-45</p>
                <p>Корпоративный отдел продаж (067)611-15-33 (Viber)</p>
                <hr/>

                <h4><b>Почта:</b></h4>
                <p><a href="mailto:domkanczap@gmail.com">domkanczap@gmail.com</a></p>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div id="map"></div>
            </div>
        </div>
    </div>
    <script>
        function initMap() {
            var uluru = {lat: 47.818936, lng: 35.200538};//47.818936, 35.200538
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