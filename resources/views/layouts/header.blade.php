<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P5QRTFB"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

    <div id="app" class="header_container">

        <!-- BEGIN common/header.html -->
        <header class="container-fluid fixed-top">
            <nav class="navbar navbar-default navbar-fixed-top navbar__wrap">
                <div class="navbar-header navbar__mobile">
                    <div class="navbar__logo-mobile visible-xs-6-inline visible-sm-6-inline">
                        <a class="navbar-brand" href="/">
                            <img alt="Project Name" src="images_service/logo.png" title="Project Name">
                        </a>
                    </div>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="container-fluid navbar-collapse collapse " id="navbar">

                    <div class="container-fluid navbar__top">
                        <div class="container">
                            <div class="navbar__secondary-menu">
                                <ul class="nav navbar-nav">

                                    <li><a href="{{route('store')}}"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Магазин</a></li>
                                    <li><a href="{{route('cart')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Корзина</a></li>
                                    <li><a href="{{route('load_price')}}"><i class="fa fa-cloud-download" aria-hidden="true"></i> Новое поступление</a></li>
                                    <li><a href="{{route('contacts')}}"><i class="fa fa-map" aria-hidden="true"></i> Контакты</a></li>
                                    <li><a href="{{route('about_us')}}"><i class="fa fa-users" aria-hidden="true"></i> О нас</a></li>
                                    <li><a href="{{route('pay')}}"><i class="fa fa-truck" aria-hidden="true"></i> Доставка/Оплата</a></li>
                                    <li class="navbar__action"><a href="{{route('sales_price')}}"><i class="fa fa-usd" aria-hidden="true"></i> Акции/Скидки</a></li>
                                </ul>
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
                    </div>
                    <div class="container-fluid navbar__middle">
                        <div class="container">
                            <div class="navbar__middle-wrap">
                                <div class="navbar__logo">
                                    <a class="navbar-brand" href="/">
                                        <img alt="Project Name" src="{{ asset('images_service/logo.png') }}" title="Project Name">
                                    </a>
                                </div>
                                <div class="navbar__time-address-search">
                                    <div class="row navbar__time-address">
                                        <div class="col-xs-12 col-sm-6 navbar__time">
                                            <div class="navbar__time-icon fa fa-clock-o"></div>
                                            <div class="navbar__time-items">
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <div>ПН-СБ</div>
                                                        <div>9:00 - 19:00</div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <div>ВС</div>
                                                        <div>9:00 - 17:00</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 navbar__address">
                                            <div class="navbar__address-icon fa fa-map-marker"></div>
                                            <div class="navbar__address-wrap">
                                                <div class="row">
                                                    <div class="col-xs-12 navbar__address-city">
                                                        г. Запорожье,
                                                    </div>
                                                    <div class="col-xs-12 navbar__address-street">
                                                        ул. Деповская, 72
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 navbar__search">
                                            <form id="navbar-search" action="{{route('store')}}" method="get">
                                                <input type="hidden" name="inputData" value="name">
                                                <div class="input-group">
                                                    <input type="text" class="form-control navbar__search-input" name="name" placeholder="Поиск товара">
                                                    <span class="input-group-btn">
                                                        <button class="btn navbar__search-button" type="submit">
                                                          <span class="navbar__search-icon ico-search"></span>
                                                        </button>
                                                    </span>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="navbar__callback-phones">
                                    <div class="navbar__phones">
                                        <div class="navbar__phones-item">
                                            <div class="navbar__phones-icon ico-phone"></div>
                                            +38 (061) 769 62 54
                                        </div>
                                        <a href="tel:380676180545" class="navbar__phones-item">
                                            <div class="navbar__phones-icon ico-kievstar"></div>
                                            +38 (067) 618 05 45
                                        </a>
                                    </div>
                                    <div class="navbar__callback">
                                        <div class="navbar__callback-input">
                                            <button id="cta_modal_open" type="button">Заказать звонок</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid navbar__bottom">
                        <div class="container">
                            <div>
                                <ul class="nav navbar-nav navbar__main-menu">

                                    @foreach($menu as $menu_item)
                                        @if(isset($menu_item['children']) && !empty($menu_item['children']))
                                            <li class="dropdown mega-dropdown">
                                                <a href="{{ asset('store/category/'. $menu_item['slug']) }}" class="dropdown-toggle @if($menu_item['name'] == 'Новогодние товары') main_ny @endif" data-toggle="dropdown">{{ $menu_item['name'] }} <span class="fa fa-caret-down"></span></a>

                                                <ul class="dropdown-menu mega-dropdown-menu row">
                                                    @foreach($menu_item['children'] as $child)
                                                        <li class="col-sm-3">
                                                            <ul>
                                                                <li class="dropdown-header"> <a href="{{ asset('store/category/'. $child['slug']) }}"> {{ $child['name'] }} </a></li>

                                                                {{--@if(isset($child['children2']) && !empty($child['children2']))--}}
                                                                    {{--@foreach($child['children2'] as $key => $child2)--}}
                                                                        {{--<li> <a href="{{ asset('store/category/'. $child2['slug']) }}"> {{ $child2['name'] }} </a></li>--}}

                                                                        {{--@if($loop->iteration >= 3)--}}
                                                                            {{--<li class="divider"></li>--}}
                                                                            {{--<li><a href="{{ asset('store/category/'. $child['slug']) }}">Все {{ $child['name'] }}</a></li>--}}
                                                                            {{--@break--}}
                                                                        {{--@endif--}}
                                                                    {{--@endforeach--}}
                                                                {{--@endif--}}

                                                            </ul>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ asset('store/category/'. $menu_item['slug']) }}" class="dropdown-toggle">{{ $menu_item['name'] }}</a>
                                            </li>
                                        @endif

                                        @if($loop->iteration >= 10)
                                            @break
                                        @endif
                                    @endforeach


                                    <li class="navbar__cart">
                                        <a href="{{route('cart')}}">
                                            <span class="navbar__cart-count badge">{{ $cart_count }}</span>
                                            <span class="navbar__cart-icon ico-cart"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </nav>
        </header>
        <!-- END common/header.html -->

    </div>
