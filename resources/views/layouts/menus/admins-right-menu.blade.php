<ul class="dropdown-menu" role="menu">

    <li><a href="{{ route('admin.ordersList') }}">Orders list</a></li>
    <li><a href="{{ route('admin.users.index') }}">Users list</a></li>
    <li><a href="{{ route('admin.managers') }}">Managers list</a></li>
    <li><a href="{{ route('admin.sliders.index') }}">Slides list</a></li>
    <li><a href="{{ route('admin.arrival.index') }}">Arrivals list</a></li>

    <li>
        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>
</ul>