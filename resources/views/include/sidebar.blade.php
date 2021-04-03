<div class="wrapper">
    <nav id="sidebar" style="z-index: 9998!important">
        <div id="dismiss">
            <i class="fa fa-arrow-left"></i>
        </div>
        <ul class="list-unstyled components">
            <p class="text-muted text-center h4">Kumar Studio</p>
            
            <li class="">
                <a href="{{ route('homepage') }}">Home</a>
            </li>
            @auth
            <li class="">
                <a href="#profile" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Profile</a>
                <ul class="collapse list-unstyled" id="profile">
                    <li>
                        <a href="#">My Account</a>
                    </li>
                    <li>
                        <a href="{{ route('my.orders') }}">My Orders</a>
                    </li>
                    <li><a class="dropdown-item small" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off text-danger"></i> Logout</a></li>
                    <form action="{{ route('logout') }}" id="logout-form" method="post">@csrf</form>
                </ul>
            </li>
            @endauth
            @php
                $categories = category()
            @endphp
            @foreach ($categories as $cat)
            <li class="">
                <a href="{{ route('filter',['name'=>$cat->slug]) }}">{{ $cat->cat_title }}</a>
            </li>
            @endforeach
            @if(!Auth::check())
            <hr>
            <li class="">
                <a href="{{ route('login') }}">Login</a>
            </li>
            <li class="">
                <a href="{{ route('register') }}">Register</a>
            </li>
            @endif
        </ul>
    </nav>
</div>