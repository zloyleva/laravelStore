<body>
    <div id="app">
        <div class="container-fluid info-bar">
            <div class="row">
                <div class="container top-bar">
                    <div class="info-address">
                        г. Запорожье, ул. Деповская 72
                    </div>
                    <div class="info-phones">
                        <a href="tel:0617699546"><i class="fa fa-phone" aria-hidden="true"></i> (061) 769 95 46</a>,
                        <a href="tel:0676180545"><i class="fa fa-mobile" aria-hidden="true"></i> (067) 618 05 45</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container logo-bar">
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="/images_service/logo.png" alt="">
            </a>
            <h3 class="logo-description">Самый крупный в Запорожье супермаркет-склад канцелярии, школьной продукции, детских игрушек и новогодних товаров</h3>
        </div>
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span>
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </span>
                        <span class="menu-text">Меню</span>
                    </button>

                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{route('store')}}"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Магазин</a></li>
                        <li><a href="{{route('cart')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Корзина</a></li>
                        <li><a href="{{route('load_price')}}"><i class="fa fa-cloud-download" aria-hidden="true"></i> Скачать</a></li>
                        <li><a href="{{route('contacts')}}"><i class="fa fa-map" aria-hidden="true"></i> Контакты</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Вход</a></li>
                            <li><a href="{{ route('register') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> Регистрация</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Привет, {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                @if( Auth::user()->role == 'user')
                                    @include('layouts.menus.users-right-menu')
                                @elseif(Auth::user()->role == 'admin' || Auth::user()->role == 'manager')
                                    @include('layouts.menus.admins-right-menu')
                                @endif
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>
