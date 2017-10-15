<ul class="dropdown-menu" role="menu">

    <li><a href="{{ route('admin.ordersList') }}">Orders list</a></li>
    <li><a href="{{ route('admin.addProducts') }}">Add products</a></li>
    <li>
        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>
</ul>