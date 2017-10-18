<ul class="dropdown-menu" role="menu">
    <li><a href="#">My Profile</a></li>
    <li><a href="{{ route('cart') }}">Cart</a></li>
    <li><a href="{{ route('orders.list') }}">Orders</a></li>
    <li>
        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>
</ul>