<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kumar Studio</title>
    <!-- CSS only -->

    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}"/>
    
    
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.min.css') }}">
    <script src="{{ asset('js/font.js') }}" crossorigin="anonymous"></script>
</head>
<style>
    .bg-theme{
        @if(!empty(site()->color))
            background-color:{{ site()->color }};
        @else
            background-color:red;
        @endif
  } 
</style>
<body>
        {{-- <div class="wrapper"> --}}
            
            <nav class="navbar desktop-navbar navbar-expand-lg bg-theme navbar-dark p-1" >
                <div class="container">
                    
                    <a href="{{ route('homepage') }}" class="navbar-brand logo">@if(!empty(site()->logo))<img src="{{ asset('logo/'.site()->logo) }}" style="height:45px;" alt="" class="img-fluid">@endif</a>
                    <form action="" class="desktop-search">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn bg-white shadow-none rounded-0"><i class="fas fa-search"></i></button>
                            </div>
                            <input type="search" name="search" size="60" class="form-control border-0 rounded-0 shadow-none">
                        </div>
                    </form>
                    <ul class="navbar-nav desktop-nav d-lg-flex d-none">
                        @guest
                        @php session()->get('cart_redirect')@endphp
                        @endguest
                        @guest
                            <li class="nav-item h-link"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                            <li class="nav-item h-link"><a href="{{ route('register') }}" class="nav-link">Register</a></li>      
                            <li class="nav-item h-link"><a href="{{ route('login') }}" class="nav-link"><i class="fas fa-shopping-cart"></i><sup><span class="badge bg-white text-dark rounded-circle">0</span></sup></a></li>
                            @php
                                $url = url()->current();
                                session()->put('cart_redirect',$url);
                            @endphp                      
                        @endguest
                        @auth
                        <li class="nav-item dropdown h-link ">
                            <a class="nav-link bg-transparent text-light text-capitalize" href="#"  id="dropdownMenuLink" data-bs-toggle="dropdown">
                                {{ user()->name }}
                            </a>
                            <ul class="dropdown-menu rounded-0" aria-labelledby="dropdownMenuLink">
                                @if(Auth::user()->is_admin == 'ADM')
                                <li><a class="dropdown-item small" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                @endif
                                @if(Auth::user()->is_admin == 'USR')
                                <li><a class="dropdown-item small" href="#">My Profile</a></li>
                                <li><a class="dropdown-item small" href="{{ route('my.orders') }}">My Orders</a></li>
                                @endif
                                <li><a class="dropdown-item small" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off text-danger"></i> Logout</a></li>
                                <form action="{{ route('logout') }}" id="logout-form" method="post">@csrf</form>
                            </ul>
                        </li>
                        <li class="nav-item h-link"><a href="{{ route('cart') }}" class="nav-link"><i class="fas fa-shopping-cart"></i><sup><span class="badge bg-white text-dark rounded-circle">{{ cart_count() }}</span></sup></a></li>
                     
                        @endauth    
                    </ul>
                    <ul class="navbar-nav mobile-cart ms-auto">
                        @guest
                            <li class="nav-item"><a href="{{ route('login') }}" class="nav-link text-light"><i class="fas fa-shopping-cart"></i><sup><span class="badge bg-white text-dark rounded-circle">0</span></sup></a></li>
                            @php
                                $url = url()->current();
                                session()->put('cart_redirect',$url);
                            @endphp  
                        @endguest
                        @auth
                            <li class="nav-item h-link"><a href="{{ route('cart') }}" class="nav-link"><i class="fas fa-shopping-cart"></i><sup><span class="badge bg-white text-dark rounded-circle">{{ cart_count() }}</span></sup></a></li>
                        @endauth
                    </ul>
                    <a class="text-white rounded ms-4  d-lg-none d-block open-menu" href="#">
                        <i class="fas fa-align-left"></i>
                    </a>
                    
                </div>
            </nav>
            <nav class="navbar navbar-expand-lg sticky-top  bg-theme navbar-dark py-2 d-lg-none search-nav" style="z-index: 1!important;">
                <form action="" class="mx-auto" style="width: calc(100% - 20px); ">
                    <div class="input-group ">
                        <div class="input-group-prepend">
                            <button class="btn bg-white shadow-none " style="border-radius:10px 0px 0px 10px;"><i class="fas fa-search"></i></button>
                        </div>
                        <input type="search" name="search" class="form-control border-0 shadow-none" style="border-radius:0px 10px 10px 0px;">
                    </div>
                </form>
            </nav>
            <nav class="navbar desktop-nav menu navbar-expand-lg shadow-sm p-0 navbar-light bg-white shadow-sm" style="z-index:1000;">
                <div class="container">
                    <ul class="navbar-nav">
                        @php
                            $category = category()
                        @endphp
                        @foreach ($category as $item)
                        <li class="nav-item cat me-3"><a href="{{ route('filter',['name'=>$item->slug]) }}" class="nav-link ps-1" style="font-family: 'Roboto', sans-serif!important; font-size:15px;">{{ $item->cat_title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </nav>
            <!-- Sidebar -->
            <nav class="sidebar">
    
                <!-- close sidebar menu -->
                {{-- <div class="dismiss">
                    <i class="fas fa-arrow-left"></i>
                </div> --}}
    
                
    
                <ul class="list-unstyled menu-elements border-0">
                    <li class="active" style="border-left: 2px solid red;">
                        <a class="scroll-link" href="#top-content"> Home</a>
                    </li>
                    @php
                        $category = category()
                    @endphp
                    @foreach ($category as $cat)
                    <li class="" style="border-left: 2px solid {{ $cat->color }};">
                        <a class="scroll-link" href="#top-content"> {{ $cat->cat_title }}</a>
                    </li>
                    @endforeach
                    
                    
                    
                </ul>
    
                <div class="dark-light-buttons">
                    <a class="btn btn-primary btn-customized-4 btn-customized-dark" href="#" role="button">Dark</a>
                    <a class="btn btn-primary btn-customized-4 btn-customized-light" href="#" role="button">Light</a>
                </div>
    
            </nav>
            <!-- End sidebar -->
            <div class="overlay"></div>
            <div class="contents">
                @yield('content')
            </div>
        {{-- </div> --}}
    <footer  style="background-image: url({{ asset('footerbg-.jpg') }}); background-size:cover; background-attachment:fixed;" class=" footer p-0">
        <div class="container-fluid p-0" style="background-color: #1c313a77;">
            <div class="container py-5">
                <div class="row row-cols-lg-2 row-cols-md-2 rows-cols-sm-2 row-cols-1">
                    <div class="col mb-4">
                        <div class="ad-pro">
                            <div class="img">@if(!empty(site()->logo))<img src="{{ asset('logo/'.site()->logo) }}" style="height:45px;" alt="" class="img-fluid">@endif</div>
                            <div class="social-icon">
                                <ul>
                                    <li><a href="" class="text-decoration-none"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="" class="text-decoration-none"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="" class="text-decoration-none"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="" class="text-decoration-none"><i class="fa fa-youtube"></i></a></li>
                                </ul>
                            </div>
                            <p class="fw-light ks-text">
                                Kumar Studio Gifts having pioneered the concept of personalized gifts in our city (purnea), today has become a driver of marketplace innovation and a contributor in local economies. The journey of KSF, much like the gifts which are at the very heart of its business, has been an organic one. Started in 2020 in Purnea, by the enterprising Mr. Kumar Mayank.
                            </p>
                        </div>
                        
                    </div>
                    <div class="col ">
                    <h5 class="text-white">Popular Products</h5>
                        
                    </div>
                </div>
            </div>
            <div class="container border-top d-flex border-secondary py-3 justify-content-middle">
                <h6 class="text-light fw-light">© 2021 Copyright Reserved</h6>
                
                <h6 class="text-light fw-light ms-auto">Developed By <a href="" target="_blank" class="text-light text-decoration-none">CWS</h6>
                
            </div>
        </div>
    </footer>


    {{-- mobile fixed bottom navigation --}}
    <nav class="navbar navbar-expand-lg d-lg-none mobile-foot-menu navbar-light bg-white fixed-bottom">
        <div class="container ">
            <div class="row d-flex w-100">
                <div class="col-3 text-center text-dark">
                    <a href="{{ route('homepage') }}" class=" text-decoration-none text-dark">
                        <i class="fas fa-home"></i>
                        <p class="h6 fw-light small">Home</p>
                    </a>
                </div>
                <div class="col-3 text-center text-dark">
                    <a href="@auth{{ route('my.orders') }}@endauth  @guest{{ route('login') }}@endguest" class=" text-decoration-none text-dark">
                    <i class="fas fa-gift"></i>
                    <p class="h6 fw-light small">Orders</p>
                    </a>
                </div>
                    <div class="col-3 text-center text-dark">
                        <a href="pokemon" class=" text-decoration-none text-dark">
                        <i class="fas fa-heart"></i>
                        <p class="h6 fw-light small">wishlist</p>
                        </a>
                    </div>
                <div class="col-3 text-center text-dark">
                    <a href="pokemon" class=" text-decoration-none text-dark">
                    <i class="fas fa-user"></i>
                    <p class="h6 fw-light small">Account</p>
                    </a>
                </div>
            </div>
        </div>
    </nav>
{{-- slider --}}
    <script>
        $(document).ready(function(){
        $('.customer-logos').slick({
            slidesToShow: 7,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 1500,
            arrows: true,
            prevArrow: $('.prev'),
            nextArrow: $('.next'),
            dots: false,
            pauseOnHover: true,
            responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 5
                }
            },
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 6
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 520,
                settings: {
                    slidesToShow: 3
                }
            }]
        });
        });
    </script>
    
    {{-- try --}}
    <script>
        (function ($) {
            ("use strict");

            // closes the sidebar menu
            $(".menu-toggle, .side-toggle").click(function (e) {
            e.preventDefault();
            $("#sidebar-wrapper").toggleClass("active");
            $(".menu-toggle > .fa-bars, .menu-toggle > .fa-times, .side-toggle > .fa-bars, .side-toggle > .fa-bars").toggleClass(
            "fa-bars fa-times"
            );
            $(this).toggleClass("active");
            });

            //smooth scrolling using jquery and easing
            $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function () {
            if (
            location.pathname.replace(/^\//, "") ==
            this.pathname.replace(/^\//, "") &&
            location.hostname == this.hostname
            ) {
            var target = $(this.hash);
            target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
            if (target.length) {
            $("html, body").animate(
                {
                scrollTop: target.offset().top,
                },
                1000,
                "easeInOutExpo"
            );
            return false;
            }
            }
            });
            $("#sidebar-wrapper .js-scroll-trigger").click(function () {
            $("#sidebar-wrapper").removeClass("active");
            $(".menu-toggle, .side-toggle").removeClass("active");
            $(".menu-toggle > fa.bars, .menu-toggle > .fa-times, .side-toggle > fa-times, .side-toggle > .fa-times").toggleClass(
            "fa-bars fa-times"
            );
            });

            $(document).scroll(function () {
            var scrollDistance = $(this).scrollTop();
            if (scrollDistance > 100) {
            $(".scroll-to-top").fadeIn();
            } else {
            $(".scroll-to-top").fadeOut();
            }
            });
            })(jQuery);

    </script>
    {{-- try end --}}

    <script>
        var lastScrollTop = 0, px = 0, scrollDownBool = false;
        $(window).scroll(function(event){
        var st = $(this).scrollTop();
        if (st > lastScrollTop){
            px += Math.abs(st - lastScrollTop);
            if (px >= 70) {px = 70;}
            document.querySelector(".menu").style.top = st-px+"px";
        } else {
            px -= Math.abs(st - lastScrollTop);
            if (px <= 0) {px = 0;}
            document.querySelector(".menu").style.top = st-px+"px"; 
        }
        lastScrollTop = st;
        });
    </script>
<!-- JavaScript Bundle with Popper -->
    <script src="{{ asset('js/jquery-3.3.1.min') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>