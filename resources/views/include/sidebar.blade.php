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
                <a href="{{ route('homepage') }}">{{ $cat->cat_title }}</a>
            </li>
            @endforeach
            <hr>
            @if(!Auth::check())
            <div class="px-4 mb-2">
                <a href="{{ route('login') }}" class="btn btn-success btn-block">Login</a>
                 
            </div>
            <div class="px-4 mb-2">
                <a href="{{ route('register') }}" class="btn btn-info btn-block">Register</a>
            </div>
            
            @endif
        </ul>
    </nav>
</div>