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