@extends('layouts.base')
@section('content')
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> --}}
    {{-- <script src="https://wp.incredibbble.com/writsy-shop/wp-content/themes/writsy-shop/assets/vendor/jquery-zoom/jquery.zoom.min.js?ver=1.7.18"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script> 
--}}

    <div class="container-fluid" style="margin-top: 30px">
        <div class="container-fluid px-2">
            <nav class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb bg-white py-3 ps-3 rounded-0 shadow-sm">
                  <li class="breadcrumb-item small"><a href="{{ route('homepage') }}" class="text-muted text-decoration-none">Home</a></li>
                  <li class="breadcrumb-item small" aria-current="page"><a href="" class="text-decoration-none text-muted">{{ $product->cat->cat_title }}</a></li>
                  <li class="breadcrumb-item active small" aria-current="page">{{ $product->title }}</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-4 mb-4 p-0">
                <div class="slider-wrapper ">
                    <div class="slider-for" style="height: auto">
                        @php
                            $images = explode(",",$product->images);
                        @endphp
                        @foreach ($images as $image)
                        <div class="slider-for__item p-0" style="outline: none!important" data-src="{{ asset('product/'.$image) }}">
                            <img src="{{ asset('product/'.$image) }}" class="img-fluid round-10 shadow-sm mb-2" style="height:400px;" alt="" />
                          </div>
                        @endforeach
                      
                      

                    </div>
                  
                    <div class="slider-nav px-3" style="outline: none!important">
                        @foreach ($images as $image)
                      <div class="slider-nav__item m-1" style="outline: none!important">
                        <img src="{{ asset('product/'.$image) }}" class="shadow-sm round-10 border-0 img-fluid h-100" alt="" />
                      </div>
                      @endforeach
                    </div>
                  </div>        
            </div>    
            <div class="col-lg-5 px-3">
                <h1 class="h4">{{ $product->title }}</h1> 
                <p class="small">{{ $product->cat->cat_title }}</p> 
                @php
                    $ratings = rating($product->id);
                    $count = count(rating($product->id));
                    $total_rating = 0
                @endphp
                @if ($count > 0)
                    @foreach ($ratings as $rating)
                    @php
                        $total_rating += $rating->ratings
                    @endphp
                @endforeach
                @if($count != 0)
                <span class="badge bg-success">
                    {{ $avg_rating = $total_rating/$count }} <i class="fa fa-star" style="font-size: 10px;"> </i>
                </span>
                <span class="small text-muted">{{ $count }} ratings</span>
                @endif
                @endif
                <p class="h5 text-danger mt-2">₹. {{ $product->discount_price }}/- <del class="ms-2 text-muted small">₹. {{ $product->price }}/-</del></p>
                <span class="badge bg-theme rounded-0 py-2 mt-2">
                    @php
                         $price = $product->price;
                         $discount_price = $product->discount_price;

                         $discount = ($price - $discount_price) / $price*100;

                         echo intval($discount);

                    @endphp
                    
                    % Discount</span>
                    {{-- <div class="delivery col-6 pl-0 mt-4">
                        <div class="input-group pl-0">
                            <div class="input-group-prepend pl-0">
                                <span class="input-group-text pl-0 bg-white border-0 "><i
                                        class="fas fa-map-marker-alt mr-2"></i> Delivery</span>
                            </div>
                            <input type="text" placeholder=" Enter Delivery Pincode"
                                class="border-left-0 border-top-0 border-right-0 border border-primary pincode-area">
                            <div class="input-group-append">
                                <a href="" class="text-primary border-5 border-bottom border-primary">check</a>
                            </div>
                        </div>
                    </div> --}}
                <div class="d-flex mt-3">
                    @auth
                    <form action="{{ route('add.to.cart',['id'=>$product->id]) }}" method="post">
                        @csrf
                        <button class="btn bg-success text-white rounded-0 shadow-none">Add to cart</button>
                    </form> 
                    @endauth
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-info rounded-0 ">Add to cart</a>
                        @php
                            $url = url()->current();
                            session()->put('redirect',$url);
                        @endphp
                    @endguest
                    
                    <a href="#details" class=" ms-2 btn btn-secondary rounded-0 ">Know More</a>
                </div>
                <div class="alert alert-secondary rounded-0 small mt-4">
                    <h6 class="fw-light fs-5">Bulk Enquiry</h6>
                    <hr>
                    Free Delivery In Purnea (Urban) <br>
                    Cancellation Allow Before Order Processing
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card bg-white shadow-sm border-0">
                    <div class="card-header bg-white border-0 bg-white d-flex">
                        <h6 class=" text-center">CUSTOMIZE PRODUCT</h6><span class="text-danger small ms-auto" style="font-size: 12px;">(Required)</span>
                    </div>
                    <div class="card-body d-flex bg-white justify-content-center ">
                           <a href="#" class="btn btn-info w-75 mx-auto">Upload Your Image/Text</a>
                    </div>    
                </div>    
            </div>    
        </div>    
    </div>    
    {{-- <div class="container-fluid mt-5 px-3" >
        <div class="card rounded-0" id="details">
            <div class="card-header rounded-0 " >Product Description</div>
            <div class="card-body" >
                <p class="">{{ $product->description }}</p>
            </div>
        </div>        
    </div> --}}
    <div class="container-fluid mt-3 px-3">
        <div class="card border-0 shadow-sm">
            <div class="card-header border-0 bg-white d-flex">
                <h5>Ratings and reviews</h5>
                @php
                    $id =  Illuminate\Support\Facades\Crypt::encryptString($product->id);
                @endphp
                <a href="{{ route('home.review',['slug'=>$product->slug , 'id'=>$id]) }}" class="btn btn-white ms-auto border rounded-0 shadow-sm ">Rate Product</a>
            </div>
            @if($count != 0)
            <div class="card-body">
                <div class="container-fluid">
                    <style>
                        .hidden {
                            visibility: hidden;
                            width: 0;
                        }
                        .progress-bar {
                            background: #f1f1f1;
                            border-radius: 5px;
                            /* box-shadow: inset 0 0 0 1px #ccd6dd; */
                            height: 7px;
                            overflow: hidden;
                            position: relative;
                            text-indent: 100%;
                            width: 200px;
                        }
                        .progress-bar--counter {
                            margin-right: 10px;
                            position: relative;
                            top: -4px;
                        }
                        .progress-bar--counter .hidden {
                            display: inline-block;
                        }
                        .progress-bar--wrap {
                            display: flex;
                            font-size: 13px;
                            font-weight: 500;
                            line-height: 1;
                            margin: 10px 0;
                        }
                        .progress-bar--inner {
                            transition: all 0.5s ease-in-out;
                            border-radius: 10px;
                            height: 7px;
                            left: 0;
                            min-height: 7px;
                            position: absolute;
                            top: 0;
                        }
 
                    </style>
                    <style>
                        .progress-circle {
                            font-size: 20px;
                            /* margin: 20px; */
                            position: relative; /* so that children can be absolutely positioned */
                            padding: 0;
                            width: 5em;
                            height: 5em;
                            background-color: #F2E9E1; 
                            border-radius: 50%;
                            line-height: 5em;
                            float: left;
                        }

                        .progress-circle:after{
                            border: none;
                            position: absolute;
                            top: 0.35em;
                            left: 0.35em;
                            text-align: center;
                            display: block;
                            border-radius: 50%;
                            width: 4.3em;
                            height: 4.3em;
                            background-color: white;
                            content: " ";
                        }
                        /* Text inside the control */
                        .progress-circle span {
                            position: absolute;
                            line-height: 5em;
                            width: 5em;
                            text-align: center;
                            display: block;
                            color: #53777A;
                            z-index: 2;
                        }
                        .left-half-clipper { 
                        /* a round circle */
                        border-radius: 50%;
                        width: 5em;
                        height: 5em;
                        position: absolute; /* needed for clipping */
                        clip: rect(0, 5em, 5em, 2.5em); /* clips the whole left half*/ 
                        }
                        /* when p>50, don't clip left half*/
                        .progress-circle.over50 .left-half-clipper {
                        clip: rect(auto,auto,auto,auto);
                        }
                        .value-bar {
                        /*This is an overlayed square, that is made round with the border radius,
                        then it is cut to display only the left half, then rotated clockwise
                        to escape the outer clipping path.*/ 
                        position: absolute; /*needed for clipping*/
                        clip: rect(0, 2.5em, 5em, 0);
                        width: 5em;
                        height: 5em;
                        border-radius: 50%;
                        border: 0.45em solid #ee4054; /*The border is 0.35 but making it larger removes visual artifacts */
                        /*background-color: #4D642D;*/ /* for debug */
                        box-sizing: border-box;
                        
                        }
                        /* Progress bar filling the whole right half for values above 50% */
                        .progress-circle.over50 .first50-bar {
                        /*Progress bar for the first 50%, filling the whole right half*/
                        position: absolute; /*needed for clipping*/
                        clip: rect(0, 5em, 5em, 2.5em);
                        background-color: #ee4054;
                        border-radius: 50%;
                        width: 5em;
                        height: 5em;
                        }
                        .progress-circle:not(.over50) .first50-bar{ display: none; }


                        /* Progress bar rotation position */
                        .progress-circle.p0 .value-bar { display: none; }
                        .progress-circle.p1 .value-bar { transform: rotate(4deg); }
                        .progress-circle.p2 .value-bar { transform: rotate(7deg); }
                        .progress-circle.p3 .value-bar { transform: rotate(11deg); }
                        .progress-circle.p4 .value-bar { transform: rotate(14deg); }
                        .progress-circle.p5 .value-bar { transform: rotate(18deg); }
                        .progress-circle.p6 .value-bar { transform: rotate(22deg); }
                        .progress-circle.p7 .value-bar { transform: rotate(25deg); }
                        .progress-circle.p8 .value-bar { transform: rotate(29deg); }
                        .progress-circle.p9 .value-bar { transform: rotate(32deg); }
                        .progress-circle.p10 .value-bar { transform: rotate(36deg); }
                        .progress-circle.p11 .value-bar { transform: rotate(40deg); }
                        .progress-circle.p12 .value-bar { transform: rotate(43deg); }
                        .progress-circle.p13 .value-bar { transform: rotate(47deg); }
                        .progress-circle.p14 .value-bar { transform: rotate(50deg); }
                        .progress-circle.p15 .value-bar { transform: rotate(54deg); }
                        .progress-circle.p16 .value-bar { transform: rotate(58deg); }
                        .progress-circle.p17 .value-bar { transform: rotate(61deg); }
                        .progress-circle.p18 .value-bar { transform: rotate(65deg); }
                        .progress-circle.p19 .value-bar { transform: rotate(68deg); }
                        .progress-circle.p20 .value-bar { transform: rotate(72deg); }
                        .progress-circle.p21 .value-bar { transform: rotate(76deg); }
                        .progress-circle.p22 .value-bar { transform: rotate(79deg); }
                        .progress-circle.p23 .value-bar { transform: rotate(83deg); }
                        .progress-circle.p24 .value-bar { transform: rotate(86deg); }
                        .progress-circle.p25 .value-bar { transform: rotate(90deg); }
                        .progress-circle.p26 .value-bar { transform: rotate(94deg); }
                        .progress-circle.p27 .value-bar { transform: rotate(97deg); }
                        .progress-circle.p28 .value-bar { transform: rotate(101deg); }
                        .progress-circle.p29 .value-bar { transform: rotate(104deg); }
                        .progress-circle.p30 .value-bar { transform: rotate(108deg); }
                        .progress-circle.p31 .value-bar { transform: rotate(112deg); }
                        .progress-circle.p32 .value-bar { transform: rotate(115deg); }
                        .progress-circle.p33 .value-bar { transform: rotate(119deg); }
                        .progress-circle.p34 .value-bar { transform: rotate(122deg); }
                        .progress-circle.p35 .value-bar { transform: rotate(126deg); }
                        .progress-circle.p36 .value-bar { transform: rotate(130deg); }
                        .progress-circle.p37 .value-bar { transform: rotate(133deg); }
                        .progress-circle.p38 .value-bar { transform: rotate(137deg); }
                        .progress-circle.p39 .value-bar { transform: rotate(140deg); }
                        .progress-circle.p40 .value-bar { transform: rotate(144deg); }
                        .progress-circle.p41 .value-bar { transform: rotate(148deg); }
                        .progress-circle.p42 .value-bar { transform: rotate(151deg); }
                        .progress-circle.p43 .value-bar { transform: rotate(155deg); }
                        .progress-circle.p44 .value-bar { transform: rotate(158deg); }
                        .progress-circle.p45 .value-bar { transform: rotate(162deg); }
                        .progress-circle.p46 .value-bar { transform: rotate(166deg); }
                        .progress-circle.p47 .value-bar { transform: rotate(169deg); }
                        .progress-circle.p48 .value-bar { transform: rotate(173deg); }
                        .progress-circle.p49 .value-bar { transform: rotate(176deg); }
                        .progress-circle.p50 .value-bar { transform: rotate(180deg); }
                        .progress-circle.p51 .value-bar { transform: rotate(184deg); }
                        .progress-circle.p52 .value-bar { transform: rotate(187deg); }
                        .progress-circle.p53 .value-bar { transform: rotate(191deg); }
                        .progress-circle.p54 .value-bar { transform: rotate(194deg); }
                        .progress-circle.p55 .value-bar { transform: rotate(198deg); }
                        .progress-circle.p56 .value-bar { transform: rotate(202deg); }
                        .progress-circle.p57 .value-bar { transform: rotate(205deg); }
                        .progress-circle.p58 .value-bar { transform: rotate(209deg); }
                        .progress-circle.p59 .value-bar { transform: rotate(212deg); }
                        .progress-circle.p60 .value-bar { transform: rotate(216deg); }
                        .progress-circle.p61 .value-bar { transform: rotate(220deg); }
                        .progress-circle.p62 .value-bar { transform: rotate(223deg); }
                        .progress-circle.p63 .value-bar { transform: rotate(227deg); }
                        .progress-circle.p64 .value-bar { transform: rotate(230deg); }
                        .progress-circle.p65 .value-bar { transform: rotate(234deg); }
                        .progress-circle.p66 .value-bar { transform: rotate(238deg); }
                        .progress-circle.p67 .value-bar { transform: rotate(241deg); }
                        .progress-circle.p68 .value-bar { transform: rotate(245deg); }
                        .progress-circle.p69 .value-bar { transform: rotate(248deg); }
                        .progress-circle.p70 .value-bar { transform: rotate(252deg); }
                        .progress-circle.p71 .value-bar { transform: rotate(256deg); }
                        .progress-circle.p72 .value-bar { transform: rotate(259deg); }
                        .progress-circle.p73 .value-bar { transform: rotate(263deg); }
                        .progress-circle.p74 .value-bar { transform: rotate(266deg); }
                        .progress-circle.p75 .value-bar { transform: rotate(270deg); }
                        .progress-circle.p76 .value-bar { transform: rotate(274deg); }
                        .progress-circle.p77 .value-bar { transform: rotate(277deg); }
                        .progress-circle.p78 .value-bar { transform: rotate(281deg); }
                        .progress-circle.p79 .value-bar { transform: rotate(284deg); }
                        .progress-circle.p80 .value-bar { transform: rotate(288deg); }
                        .progress-circle.p81 .value-bar { transform: rotate(292deg); }
                        .progress-circle.p82 .value-bar { transform: rotate(295deg); }
                        .progress-circle.p83 .value-bar { transform: rotate(299deg); }
                        .progress-circle.p84 .value-bar { transform: rotate(302deg); }
                        .progress-circle.p85 .value-bar { transform: rotate(306deg); }
                        .progress-circle.p86 .value-bar { transform: rotate(310deg); }
                        .progress-circle.p87 .value-bar { transform: rotate(313deg); }
                        .progress-circle.p88 .value-bar { transform: rotate(317deg); }
                        .progress-circle.p89 .value-bar { transform: rotate(320deg); }
                        .progress-circle.p90 .value-bar { transform: rotate(324deg); }
                        .progress-circle.p91 .value-bar { transform: rotate(328deg); }
                        .progress-circle.p92 .value-bar { transform: rotate(331deg); }
                        .progress-circle.p93 .value-bar { transform: rotate(335deg); }
                        .progress-circle.p94 .value-bar { transform: rotate(338deg); }
                        .progress-circle.p95 .value-bar { transform: rotate(342deg); }
                        .progress-circle.p96 .value-bar { transform: rotate(346deg); }
                        .progress-circle.p97 .value-bar { transform: rotate(349deg); }
                        .progress-circle.p98 .value-bar { transform: rotate(353deg); }
                        .progress-circle.p99 .value-bar { transform: rotate(356deg); }
                        .progress-circle.p100 .value-bar { transform: rotate(360deg); }

                    </style>
                    <div class="row">
                        <div class="col-lg-5 d-flex">
                            <div class="row">
                                <div class="col mb-3 d-lg-block d-flex justify-content-center col-lg-3 col-md-3 col-sm-3">
                                        @if ($count != 0) 
                                            @php
                                                $avg_rating =  $total_rating/$count
                                            @endphp
                                        @endif
                                  
                                    <div class="progress-circle me-4 over50  
                                        @if($count != 0)
                                        @if($avg_rating == 1) p20
                                        @elseif($avg_rating == 1.1) p22
                                        @elseif($avg_rating == 1.2) p24
                                        @elseif($avg_rating == 1.3) p26
                                        @elseif($avg_rating == 1.4) p28
                                        @elseif($avg_rating == 1.5) p30
                                        @elseif($avg_rating == 1.6) p32
                                        @elseif($avg_rating == 1.7) p34
                                        @elseif($avg_rating == 1.8) p36
                                        @elseif($avg_rating == 1.9) p38
                                        @elseif($avg_rating == 2) p40
                                        @elseif($avg_rating == 2.1) p42
                                        @elseif($avg_rating == 2.2) p44
                                        @elseif($avg_rating == 2.3) p46
                                        @elseif($avg_rating == 2.4) p48
                                        @elseif($avg_rating == 2.5) p50
                                        @elseif($avg_rating == 2.6) p52
                                        @elseif($avg_rating == 2.7) p54
                                        @elseif($avg_rating == 2.8) p56
                                        @elseif($avg_rating == 2.9) p58
                                        @elseif($avg_rating == 3) p60
                                        @elseif($avg_rating == 3.1) p62
                                        @elseif($avg_rating == 3.2) p64
                                        @elseif($avg_rating == 3.3) p66
                                        @elseif($avg_rating == 3.4) p68
                                        @elseif($avg_rating == 3.5) p70
                                        @elseif($avg_rating == 3.6) p72
                                        @elseif($avg_rating == 3.7) p74
                                        @elseif($avg_rating == 3.8) p76
                                        @elseif($avg_rating == 3.9) p78
                                        @elseif($avg_rating == 4) p80 
                                        @elseif($avg_rating == 4.1) p82 
                                        @elseif($avg_rating == 4.2) p84 
                                        @elseif($avg_rating == 4.3) p86 
                                        @elseif($avg_rating == 4.4) p88 
                                        @elseif($avg_rating == 4.5) p90 
                                        @elseif($avg_rating == 4.6) p92 
                                        @elseif($avg_rating == 4.7) p94
                                        @elseif($avg_rating == 4.8) p96
                                        @elseif($avg_rating == 4.9) p98
                                        @elseif($avg_rating == 5) p100
                                        @endif 
                                        @endif
                                    ">
                                        <span class="text-theme">@if($count != 0){{ $avg_rating }}@endif <i class="fa fa-star" style="font-size: 15px;"> </i></span>
                                        <div class="left-half-clipper ">
                                           <div class="first50-bar"></div>
                                           <div class="value-bar"></div>
                                        </div>
                                     </div>
                                     {{-- <p>3434 ratings</p> --}}
                                </div>
                                <div class="col d-lg-block d-flex justify-content-center">
                                    @php
                                        
                                        $rating_5 = count_ratings([
                                            'ratings'=>5,
                                            'product_id'=>$product->id
                                            ]);
                                        $rating_4 = count_ratings([
                                            'ratings'=>4,
                                            'product_id'=>$product->id
                                            ]);
                                        $rating_3 = count_ratings([
                                            'ratings'=>3,
                                            'product_id'=>$product->id
                                            ]);
                                        $rating_2 = count_ratings([
                                            'ratings'=>2,
                                            'product_id'=>$product->id
                                            ]);
                                        $rating_1 = count_ratings([
                                            'ratings'=>1,
                                            'product_id'=>$product->id
                                            ]);
                                    @endphp
                                    <div class="ms-lg-3 ms-md-3 ms-sm-3 border-0">
                                        <div class="progress-bar--wrap progress-bar--green">
                                            <span class="progress-bar--counter text-dark">5 <i class="fa fa-star" style="font-size: 8px;"></i></span>
                                            <div class="progress-bar">
                                            Progress
                                            <div class="progress-bar--inner bg-success" style="width: 
                                                @if(count($rating_5)!= 0)
                                                    @if(5/$count == 5)
                                                        100%
                                                    @elseif(5/$count >= 4.5)
                                                        90%
                                                    @elseif(5/$count >= 4)
                                                        80%
                                                    @elseif(5/$count >= 3.5)
                                                        70%
                                                    @elseif(5/$count >= 3)
                                                        60%
                                                    @elseif(5/$count >= 2.5)
                                                        50%
                                                    @elseif(5/$count >= 2)
                                                        40%
                                                    @elseif(5/$count >= 1.5)
                                                        30%
                                                    @elseif(5/$count >= 1)
                                                        20%
                                                    @elseif(5/$count >= 0.5)
                                                        10%
                                                    @elseif(5/$count = 0)
                                                        0%
                                                    @endif
                                                @endif
                                            ;"></div>
                                            </div>
                                            <span class="progress-bar--counter ms-2">{{ count($rating_5) }}</span>
                                        </div>
                                        <div class="progress-bar--wrap progress-bar--blue">
                                            <span class="progress-bar--counter text-dark">4 <i class="fa fa-star" style="font-size: 8px;"></i></span>
                                            <div class="progress-bar">
                                            Progress
                                            <div class="progress-bar--inner bg-success" style="width:
                                                @if(count($rating_4)!= 0)
                                                    @if(4/$count == 5)
                                                        100%
                                                    @elseif(4/$count >= 4.5)
                                                        90%
                                                    @elseif(4/$count >= 4)
                                                        80%
                                                    @elseif(4/$count >= 3.5)
                                                        70%
                                                    @elseif(4/$count >= 3)
                                                        60%
                                                    @elseif(4/$count >= 2.5)
                                                        50%
                                                    @elseif(4/$count >= 2)
                                                        40%
                                                    @elseif(4/$count >= 1.5)
                                                        30%
                                                    @elseif(4/$count >= 1)
                                                        20%
                                                    @elseif(4/$count >= 0.5)
                                                        10%
                                                    @elseif(4/$count = 0)
                                                        0%
                                                    @endif
                                                @endif
                                            ;"></div>
                                            </div>
                                            <span class="progress-bar--counter ms-2">{{ count($rating_4) }}</span>
                                        </div>
                                        <div class="progress-bar--wrap progress-bar--red">
                                            <span class="progress-bar--counter text-dark">3 <i class="fa fa-star" style="font-size: 8px;"></i></span>
                                            <div class="progress-bar">
                                            Progress
                                            <div class="progress-bar--inner bg-success" style="width: 
                                                @if(count($rating_3)!= 0)
                                                    @if(3/$count == 5)
                                                        100%
                                                    @elseif(3/$count >= 4.5)
                                                        90%
                                                    @elseif(3/$count >= 4)
                                                        80%
                                                    @elseif(3/$count >= 3.5)
                                                        70%
                                                    @elseif(3/$count >= 3)
                                                        60%
                                                    @elseif(3/$count >= 2.5)
                                                        50%
                                                    @elseif(3/$count >= 2)
                                                        40%
                                                    @elseif(3/$count >= 1.5)
                                                        30%
                                                    @elseif(3/$count >= 1)
                                                        20%
                                                    @elseif(3/$count >= 0.5)
                                                        10%
                                                    @elseif(3/$count = 0)
                                                        0%
                                                    @endif
                                                @endif
                                            ;"></div>
                                            </div>
                                            <span class="progress-bar--counter ms-2">{{ count($rating_3) }}</span>
                                        </div>
                                        <div class="progress-bar--wrap progress-bar--yellow">
                                            <span class="progress-bar--counter text-dark">2 <i class="fa fa-star" style="font-size: 8px;"></i></span>
                                            <div class="progress-bar">
                                            Progress
                                            <div class="progress-bar--inner bg-warning" style="width: 
                                                @if(count($rating_2)!= 0)
                                                    @if(2/$count == 5)
                                                        100%
                                                    @elseif(2/$count >= 4.5)
                                                        90%
                                                    @elseif(2/$count >= 4)
                                                        80%
                                                    @elseif(2/$count >= 3.5)
                                                        70%
                                                    @elseif(2/$count >= 3)
                                                        60%
                                                    @elseif(2/$count >= 2.5)
                                                        50%
                                                    @elseif(2/$count >= 2)
                                                        40%
                                                    @elseif(2/$count >= 1.5)
                                                        30%
                                                    @elseif(2/$count >= 1)
                                                        20%
                                                    @elseif(2/$count >= 0.5)
                                                        10%
                                                    @elseif(2/$count = 0)
                                                        0%
                                                    @endif
                                                @endif
                                            ;"></div>
                                            </div>
                                            <span class="progress-bar--counter ms-2">{{ count($rating_2) }}</span>
                                        </div>
                                        <div class="progress-bar--wrap progress-bar--yellow">
                                            <span class="progress-bar--counter text-dark">1 <i class="fa fa-star" style="font-size: 8px;"></i></span>
                                            <div class="progress-bar">
                                            Progress
                                            <div class="progress-bar--inner bg-danger" style="width: 
                                                @if(count($rating_1)!= 0)
                                                    @if(1/$count == 5)
                                                        100%
                                                    @elseif(1/$count >= 4.5)
                                                        90%
                                                    @elseif(1/$count >= 4)
                                                        80%
                                                    @elseif(1/$count >= 3.5)
                                                        70%
                                                    @elseif(1/$count >= 3)
                                                        60%
                                                    @elseif(1/$count >= 2.5)
                                                        50%
                                                    @elseif(1/$count >= 2)
                                                        40%
                                                    @elseif(1/$count >= 1.5)
                                                        30%
                                                    @elseif(1/$count >= 1)
                                                        20%
                                                    @elseif(1/$count >= 0.5)
                                                        10%
                                                    @elseif(1/$count = 0)
                                                        0%
                                                    @endif
                                                @endif
                                            ;"></div>
                                            </div>
                                            <span class="progress-bar--counter ms-2">{{ count($rating_1) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            @php
                                $rating_data = count_ratings(['product_id'=>$product->id])
                            @endphp
                            @foreach ($rating_data as $rd)
                            <div class="card rounded-0">
                                <div class="card-body">
                                    <h6><span class="badge bg-success">{{ $rd->ratings }} <i class="fa fa-star" style="font-size: 9px;"></i></span> <span class="small fw-bold ms-3">{{ $rd->review_title }}!</span></h6>
                                    <p class="fw-bold small">{{ $rd->review_description }}</p>
                                    <p class="small fw-bold text-muted">{{ $rd->r_user->name }} | on {{ date('d M Y ',strtotime($rd->created_at)) }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>                
            @else
               <h4 class="text-center h5 mb-4">No rating and reviews yet!</h4> 
            @endif
        </div>
    </div>
    <div class="container-fluid px-3 my-5 ">
        <div class="head p-0 m-0" style="border-bottom: 4px solid #ee4054;">
            <div class="d-inline-flex px-4 py-1 pb-2 text-white bg-theme">Similar Products</div>
            <a href="" class="text-muted text-decoration-none float-end">view all</a>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-5 g-2 pb-5">
            @foreach ($s_products as $item)
            <div class="col">
                <div class="card border-0 shadow-sm post-item" style="border-radius: 5px;">
                    <img src="{{ asset('product/'.$item->cover_image) }}" style="height: 266px; object-fit:cover; object-position:center;" alt="" class="img-fluid card-img-top">
                    <div class="card-body">
                        <a href="" class="stretched-link text-dark"><h6 class="text-truncate">{{ $item->title }}</h6></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @section('js')
    <script>
        // SLICK
           $('.slider-for').slick({
           slidesToShow: 1,
           slidesToScroll: 1,
           arrows: false,
           fade: true,
           asNavFor: '.slider-nav'
           });
           $('.slider-nav').slick({
           slidesToShow: 4,
           arrows:false,
           slidesToScroll: 1,
           asNavFor: '.slider-for',
           dots: false,
           focusOnSelect: true
           });

           
   </script>
    @endsection
@endsection
