<ul class="dropdown-menu" role="menu">

    <li><a href="{{ route('admin.ordersList') }}">Заказы</a></li>
    <li><a href="{{ route('admin.users.index') }}">Пользователи</a></li>
    <li><a href="{{ route('admin.managers') }}">Менеджеры</a></li>
    <li><a href="{{ route('admin.sliders.index') }}">Слайдер</a></li>
    <li><a href="{{ route('admin.arrival.index') }}">Arrivals list</a></li>
    <li><a href="{{ route('admin.sales.index') }}">Распродажи</a></li>

    <li>
        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Выход</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>
</ul>