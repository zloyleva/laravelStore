<body>
    @guest
        <div class="container-fluid guest_msg">
            <div class="row">
                <p>Вы видите розничную цену на товары. Для сотрудничества позвоните нашим менеджерам или нажмите "заказать звонок"</p>
            </div>
        </div>
    @endguest
    <div id="app" class="header_container">
        <div class="container-fluid">
            <div class="row info-bar">
                <div class="container">
                    <b>г. Запорожье, ул. Деповская 72</b>
                </div>
            </div>
        </div>
        <div class="container header_info">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 logo_section">
                    <!-- Branding Image -->
                    <a class="navbar-brand-link" href="{{ url('/') }}">
                        <img src="{{ url('/') }}/images_service/logo-shadow.png" alt="">
                    </a>
                </div>
                <div class="col-xs-12 col-sm-7 col-md-4 col-lg-4 contact_section">
                    <div class="info-phones">
                        <a href="tel:0617699546"><i class="fa fa-phone" aria-hidden="true"></i> (061) 769 95 46</a>
                        <a href="tel:0676180545"><img src="{{ url('/') }}/images_service/kyivstar.png" alt=""> (067) 618 05 45</a>
                    </div>
                    <div class="cta">
                        <button id="cta_modal_open" class="btn btn-cta">Заказать обратный звонок</button>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 login_cart">
                    @guest
                        <div class="login_menu">
                            <a class="btn" href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Вход</a>
                            <a class="btn" href="{{ route('register') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> Регистрация</a>
                        </div>
                    @else
                        <a href="{{route('cart')}}" class="header_cart"><img src="{{ url('/') }}/images_service/cart.png" alt=""><span class="cart_title">Корзина</span></a>
                    @endguest
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 logo_description_section">
                    <h3 class="logo-description">Самый крупный в Запорожье супермаркет-склад канцелярии, школьной продукции, детских игрушек и новогодних товаров</h3>
                </div>
            </div>

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
