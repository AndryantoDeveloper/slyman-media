<ul class="nav navbar-top-links navbar-right">
    <li>
        <a href="javascript:void(0);">
            <i class="fa fa-user fa-fw"></i> 
            {{ \Auth::User()->name }}
        </a>
    </li>
    <li>
        <a href="{{ route('home') }}"><i class="fa fa-shopping-cart fa-fw"></i> Shopping Chart</a>
    </li>
    <li>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out fa-fw"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>
</ul>