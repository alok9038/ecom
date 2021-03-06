<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecom Personalized Store</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- fontawesomes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="crossorigin="anonymous"></script> --}}
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>

    @yield('css')
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
</head>
<body>
    <style>
        @media only screen and ( max-width: 992px) {
            .main-nav{
                z-index: 3!important;
            }
        }
        @keyframes myanimation {
        0%   {
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -o-transform: scale(1);
            -ms-transform: scale(1);
            transform: scale(1)
        }
        50%  {
            -webkit-transform: scale(2);
            -moz-transform: scale(2);
            -o-transform: scale(2);
            -ms-transform: scale(2);
            transform: scale(1.5)
        }
        100%  {
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -o-transform: scale(1);
            -ms-transform: scale(1);
            transform: scale(1)
        }
        }
        .heart-animate {
            animation-name: myanimation;
            animation-duration: 3s;
            animation-iteration-count: 1;
        }
    </style>
    @include('sweetalert::alert')
    @include('include.sidebar')
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top main-nav" style="background-color:#ee4054;">
            <div class="container">
                <ul class="navbar-nav d-flex d-lg-none">
                    <li class="nav-item"><a href="#" id="sidebarCollapse" class="nav-link"><i class="fa fa-align-left text-light"></i></a></li>
                </ul>
                <a href="{{ route('homepage') }}" class="navbar-brand mx-auto mx-lg-0 mx-md-0">Kumar Studio</a>
                <form action="{{ route('search') }}" method="GET" class="mx-auto d-lg-flex d-none">
                    <div class="d-flex bg-white round-15 p-1">
                        <input type="search" name="search"  size="50" placeholder="search gifts here .. " class="form-control border-0 shadow-none round-15">
                        <button class="btn round-15 shadow-none bg-theme text-white px-3"><i class="fa fa-search"></i></button>
                    </div> 
                </form>
                <ul class="navbar-nav d-lg-flex d-none">
                    @guest
                        @php session()->get('cart_redirect')@endphp
                        @endguest
                        @guest
                            <li class="nav-item h-link"><a href="{{ route('login') }}" class="nav-link fw-light text-light">Login</a></li>
                            <li class="nav-item h-link"><a href="{{ route('register') }}" class="nav-link fw-light text-light">Register</a></li>      
                            <li class="nav-item h-link"><a href="{{ route('login') }}" class="nav-link fw-light text-light"><i class="fa fa-shopping-cart"></i><sup><span class="badge bg-white text-dark rounded-circle">0</span></sup></a></li>
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
                        <li class="nav-item h-link"><a href="{{ route('cart') }}" class="nav-link"><i class="fa text-light fa-shopping-cart"></i><sup><span class="badge bg-white text-dark rounded-circle">{{ cart_count() }}</span></sup></a></li>
                        @endauth
                </ul>
                @guest
                    <ul class="navbar-nav d-flex d-lg-none">
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link"><i class="fa fa-shopping-cart text-light"></i></a></li>
                    </ul>
                @endguest
                @auth
                    <ul class="navbar-nav d-flex d-lg-none">
                        <li class="nav-item"><a href="{{ route('cart') }}" class="nav-link"><i class="fa fa-shopping-cart text-light"></i><sup><span class="badge bg-white text-dark rounded-circle">{{ cart_count() }}</span></sup></a></li>
                    </ul>
                @endauth
            </div>
        </nav>
        <nav class="navbar-expand-lg navbar-dark pb-2 d-lg-none d-flex bg-theme">
            <div class="container">
                <form action="{{ route('search') }}" method="get" class="mx-auto">
                    <div class="d-flex bg-white round-15 p-1">
                        <input type="search" size="50" name="search" placeholder="search gifts here .. " class="form-control border-0 shadow-none round-15">
                        <button class="btn round-15 shadow-none bg-theme text-white px-3"><i class="fa fa-search"></i></button>
                    </div> 
                </form>
            </div>
        </nav>
        <nav class="navbar menu navbar-expand-lg navbar-light bg-white p-0 mat-shadow-sm d-lg-block d-none" style="z-index:1000;">
            <div class="container">
                <ul class="navbar-nav">
                    @php
                        $category = category()
                    @endphp
                    <li class="nav-item cat me-3"><a href="/" class="nav-link ps-1 text-capitalize">Home</a></li>
                    @foreach ($category as $item)
                    <li class="nav-item cat me-3"><a href="{{ route('filter',['name'=>$item->slug]) }}" class="nav-link ps-1 text-capitalize">{{ $item->cat_title }}</a></li>
                    @endforeach
                </ul>
            </div>
        </nav>

    @yield('content')

    @include('include.footer')
    <!-- JavaScript Bundle with Popper -->
    <style>
        .overlay {
          display: none;
          width: 100%;
          background: rgba(0, 0, 0, 0.7);
          z-index: 998;
          opacity: 0;
          transition: all 0.5s ease-in-out;
          min-height: 100%!important;
          position: fixed!important;
          top: 0;
          right: 0;
        }
      </style>
    <div class="overlay"></div>

    <div class="container-fluid py-3 bg-white sticky-bottom fixed-bottom mobile-footer-menu d-lg-none d-flex" style="z-index: 10000">
        <div class="container">
            <div class="row">
                <div class="col d-flex justify-content-center"><a href="{{ route('homepage') }}" class="text-decoration-none"><i class="fa fa-home @if(Request::segment(1) == '') text-theme @endif" style="font-size: 18px!important"></i></div></a>
                <div class="col d-flex justify-content-center"><a href="{{ route('homepage') }}" class="text-decoration-none"><i class="fa fa-heart" style="font-size: 18px!important"></i></div></a>
                <div class="col d-flex justify-content-center"><a href="{{ route('homepage') }}" class="text-decoration-none"><i class="fa fa-user" style="font-size: 18px!important"></i></div></a>
                @auth
                    <div class="col d-flex justify-content-center"><a href="{{ route('cart') }}" class="text-decoration-none"><i class="fa fa-shopping-cart @if(Request::segment(1) == 'cart') text-theme @endif" style="font-size: 18px!important"></i><sup><span class="badge @if(Request::segment(1) == 'cart') bg-theme @endif bg-dark text-white rounded-circle" style="font-family: sans-serif!important;">{{ cart_count() }}</span></sup></div></a>
                @endauth
                @guest
                    <div class="col d-flex justify-content-center"><a href="{{ route('cart') }}" class="text-decoration-none"><i class="fa fa-shopping-cart @if(Request::segment(1) == 'cart') text-theme @endif" style="font-size: 18px!important"></i></div></a>
                @endguest
            </div>
        </div>
    </div>
    @yield('js')
    <script>
        $(document).ready(function(){
              $('.top-offer').slick({
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  autoplay: true,
                  autoplaySpeed: 2500,
                  arrows: true,
                  prevArrow: '<span class=" mat-shadow p-3 slick-prev rounded-circle d-flex justify-content-center align-items-center"><i class="fa fa-angle-left"></i></span>',
                  nextArrow: '<span class=" mat-shadow p-3 slick-next rounded-circle d-flex justify-content-center align-items-center"><i class="fa fa-angle-right"></i></span>',
                  dots: false,
                  pauseOnHover: true,
                  responsive: [
                  {
                      breakpoint: 992,
                      settings: {
                          slidesToShow: 1
                      }
                  },
                  {
                      breakpoint: 1200,
                      settings: {
                          slidesToShow: 1
                      }
                  },
                  {
                      breakpoint: 668,
                      settings: {
                          slidesToShow: 1 
                      }
                  },
                  {
                      breakpoint: 520,
                      settings: {
                          slidesToShow: 1 
                      }
                      
                  }]
              });
          });
        
      </script>
      @auth
        <script>
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
                // function getWishlistData(){
                $(document).ready(function(getData) {
                $.ajax({
                    url: "/wishlist_view",
                    type: "POST",
                    // data:{ 
                    //     user_id:user_id, product_id:product_id
                    // },
                    cache: false,
                    dataType: 'json',
                    success: function(dataResult){
                        // console.log(dataResult);
                        var resultData = dataResult.data;
                        var resultData1 = dataResult.status;
                        // var i=1;
                        // console.log(resultData.product_id);
                        if(resultData1 == 1){
                        $.each(resultData,function(index,row){
                            $('.wislist_heart_'+row.product_id).addClass('text-danger fa-heart')
                            $('.wislist_heart_'+row.product_id).removeClass('fa-heart-o')
                        });
                        }
                        // $("#bodyData").append(bodyData);
                    }
                });
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).ready(function() {
                $('.asdf_wishlist').click(function(e) {
                    e.preventDefault();
                    var el = this;
                    var id = this.id;
                    var splitid = id.split("_");

                    // Add id
                    var user_id = splitid[0];
                    var product_id = splitid[1];
                    // AJAX Request
                    $.ajax({
                        url:'/wishlist',
                        type: 'POST',
                        data:{
                            user_id:user_id, 
                            product_id:product_id
                        },
                        success: function(response) {
                            console.log(response);
                            if (response === '1') {
                                $.ajax({
                                    url: "/wishlist_view",
                                    type: "POST",
                                    // data:{ 
                                    //     user_id:user_id, product_id:product_id
                                    // },
                                    cache: false,
                                    dataType: 'json',
                                    success: function(dataResult){
                                        // console.log(dataResult);
                                        var resultData = dataResult.data;
                                        var resultData1 = dataResult.status;
                                        // var i=1;
                                        // console.log(resultData.product_id);
                                        if(resultData1 == 1){
                                        $.each(resultData,function(index,row){
                                            $('.wislist_heart_'+row.product_id).removeClass('text-dark fa-heart-o')
                                            $('.wislist_heart_'+row.product_id).addClass('text-danger fa-heart')
                                        });
                                        }
                                    }
                                });
                            }
                            else if(response == 0) {
                                var heart = $('.wishlist_heart_'+product_id);
                                $.ajax({
                                    url:'/wishlist_remove',
                                    type: 'POST',
                                    data:{
                                        product_id:product_id
                                    },
                                    success: function(response) {
                                        // heart.fadeOut("slow");
                                        $('.wislist_heart_'+product_id).addClass('text-dark fa-heart-o')
                                        $('.wislist_heart_'+product_id).removeClass('text-danger fa-heart')
                                    }
                                    // $(this).parents(".wislist_heart_'+product_id").animate({ backgroundColor: "#fbc7c7" }, "fast")
                                });
                            }
                        }
                    });
                });
            });
        </script>
                
      @endauth
      <script>
        // Mobile Sidebar by ALok
        $(document).ready(function () {
              $("#sidebar").mCustomScrollbar({
                  theme: "minimal"
              });
  
              $('#dismiss, .overlay').on('click', function () {
                  $('#sidebar').removeClass('active');
                  $('.overlay').removeClass('active');
              });
  
              $('#sidebarCollapse').on('click', function () {
                  $('#sidebar').addClass('active');
                  $('.overlay').addClass('active');
                  $('.collapse.in').toggleClass('in');
                  $('a[aria-expanded=true]').attr('aria-expanded', 'false');
              });
          });
    </script>

    <script src="{{ asset('assets/js/slider.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>