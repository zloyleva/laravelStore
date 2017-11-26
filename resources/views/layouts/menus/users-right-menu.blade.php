<ul class="dropdown-menu" role="menu">
    <li><a href="{{ route('my_profile') }}"><i class="fa fa-user" aria-hidden="true"></i> Мой профиль</a></li>
    <li><a href="{{ route('cart') }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Корзина</a></li>
    <li><a href="{{ route('orders.list') }}"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Заказы</a></li>
    <li>
        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-power-off" aria-hidden="true"></i> Выйти</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>
</ul>