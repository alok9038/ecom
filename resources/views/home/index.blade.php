@extends('layouts.base')
@section('css')
<style>
    .slick-prev, .slick-next {
      position: absolute;
      top: 50%;
      font-size: 1.8rem;
    }    
    .slick-prev {
      left: 0;
    }    
    .slick-next {
      right: 0;
    }
    .category-slider{
        height: auto;
    }
    .category-img{
        height: auto; 
        width: auto!important;
        border-radius: 50%;
    }
    .category-card:hover{
        transform: scale(1.08);
    }
    .category-card{
      transition: all .3s linear;
    }
</style>
@endsection
@section('content')
    
    <div class="container-fluid pt-4 p-0 bg-light">
        <div class="container-fluid p-0">
            <div class="mx-auto p-0">
                <section class="top-offer w-100 slider">      
                    <div class="slide py-2" style="height: auto; outline:none;">
                        <img src="assets/images/slider/img_1.webp" class="round-25 slide-img img-fluid mat-shadow-sm">
                    </div>     
                    <div class="slide py-2" style="height: auto; outline:none;">
                        <img src="assets/images/slider/img_2.jpg" class="round-25 slide-img img-fluid mat-shadow-sm">
                    </div>     
                    <div class="slide py-2" style="height: auto; outline:none;">
                        <img src="assets/images/slider/img_3.webp" class="round-25 slide-img img-fluid mat-shadow-sm">
                    </div>     
                </section>
            </div>
          </div> 
        {{-- banner section end --}}
    
        {{-- category section --}}
        <div class="container-fluid mx-auto my-lg-4 pt-3 round-25  bg-light" style="width: 90%!important;">
            <div class="mx-auto">
                <section class="categories w-100 h-auto slider mt-3">
                    @php
                        $category = category()
                    @endphp      
                    @foreach ($category as $cat)
                    <div class="slide py-2 category-slider" style="height: auto; outline:none!important;">
                        <div class="card bg-transparent border-0">
                            <div class="card-body cat rounded-circle d-flex justify-content-center mat-shadow-sm category-card" style="background-color: {{ $cat->color }}; padding:2px;">
                                <img src="{{ asset('category/'.$cat->image) }}" class="category-img card-img-top img-fluid">
                            </div>
                            <div class="card-footer bg-transparent border-0">
                                <p class="small text-center text-truncate">{{ $cat->cat_title }}</p>
                            </div>
                            <a href="{{ route('filter',['name'=>$cat->slug]) }}" title="{{ $cat->cat_title }}" class="stretched-link"></a>
                        </div>
                    </div>
                    @endforeach                   
                </section>
            </div>
          </div> 
        {{-- category section end --}}
    
        {{-- latest collection --}}
        @if(count($products) > 0)
        <div class="container-fluid pt-4 pb-lg-5 pb-4 bg-white">
            <div class="head text-center"><h4 class="fw-light text-center">Latest Collections <br> <img src="{{ asset('star.jpg') }}" alt="" class="img-fluid" style="width: 360px;"></h4></div>
            <section class="products w-100 slider mt-3 mb-5" style="height: 330px;">      
                @foreach ($products as $product)
                    <div class="slide py-2 mx-2" style="height: auto; outline:none!important;">
                        <div class="card mx-auto border-0 mx-auto mat-shadow-sm round-10" style="width: 90%;">
                            <a href="{{ route('home.product',['name'=>$product->slug]) }}" title="{{ $product->title }}" class="" style="outline:none!important;">
                                <div class="card-body p-0">
                                    <img src="{{ asset('product/'.$product->cover_image) }}" style="height: 233px;" class="img-fluid round-lt-rt card-img-top" alt="">
                                </div>
                            </a>
                            <div class="card-footer border-0 bg-transparent">
                                <a href="{{ route('home.product',['name'=>$product->slug]) }}" title="{{ $product->title }}" style="outline: none!important" class=" text-decoration-none text-dark">
                                    <p class="text-truncate">{{ $product->title }}</p>
                                </a>
                                <h6 class="text-theme">₹. {{ $product->discount_price }}/- <span class="text-dark small float-end"><del>₹. {{ $product->price }}/-</del></span></h6>
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
                                <span class="badge bg-success">
                                    {{ $avg_rating = $total_rating/$count }} <i class="fa fa-star" style="font-size: 10px;"> </i>
                                </span>
                                @endif
                                @guest
                                    <a href="{{ route('login') }}" class="text-decoration-none float-end"><i class="fa fa-heart-o"></i></a>
                                @endguest
                                @auth
                                    <button class="float-end bg-transparent border-0 asdf_wishlist" id="{{ Auth::id() }}_{{ $product->id }}"><i class="fa fa-heart-o wislist_heart_{{ $product->id }}"></i> </button>
                                @endauth
                                {{-- <style>
                                    .HeartAnimation {
                                        padding-top: 2em;
                                        background-image: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/66955/web_heart_animation.png');
                                        background-repeat: no-repeat;
                                        background-size: 2900%;
                                        background-position: left;
                                        height: 50px;
                                        width: 50px;
                                        margin: 0 auto;
                                        cursor: pointer;
                                        }
                                        .animate {
                                        animation: heart-burst .8s steps(28) forwards;
                                        }

                                        @keyframes heart-burst {
                                            0% {
                                                background-position: left
                                            }
                                            100% {
                                                background-position: right
                                            }
                                        }
                                </style> --}}
                                {{-- <div class="HeartAnimation"></div> --}}
                                {{-- <script>
                                    $(function() {
                                        $(".HeartAnimation").click(function() {
                                            $(this).toggleClass("animate");
                                        });
                                        });
                                </script> --}}
                            </div>
                        </div>
                    </div>  
                @endforeach
            </section>
        </div>
        @endif
    </div>
    {{-- latest collection end --}}
    @php
        $categories = category()
    @endphp 
    @if(!$categories->isEmpty())
    @foreach ($categories as $category)
    @php
        $ParaMeter['CategoryId'] = $category->id;
        $products = App\Models\Product::CountProducts($ParaMeter);
    @endphp
    @if (count($products) > 0)
    <div class="container py-4">
        <div class="head text-center"><h4 class="fw-light text-center text-capitalize">{{ $category->cat_title }}<br> <img src="{{ asset('star.jpg') }}" alt="" class="img-fluid" style="width: 360px;"></h4></div>
        <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 row-cols-sm-2">
            @php
                $ParaMeter['id'] = $category->id;
                $products = App\Models\Product::GetAllProducts($ParaMeter);
                $i = 0;
            @endphp
            @foreach ($products as $product)
            @php
                $i ++;
                if($i > 4){
                    break;
                }
            @endphp
            <div class="col">
                <div class="card border-0 mat-shadow-sm product-card mx-auto round-10">
                    <a href="{{ route('home.product',['name'=>$product->slug]) }}" title="{{ $product->title }}" class="stretched">
                        <div class="card-body p-0">
                            <img src="{{ asset('product/'.$product->cover_image) }}" style="height: 233px;" class="img-fluid round-lt-rt card-img-top" alt="">
                        </div>
                    </a>
                    <div class="card-footer border-0 bg-transparent">
                        <a href="{{ route('home.product',['name'=>$product->slug]) }}" title="{{ $product->title }}" class="stretched"><p>{{ $product->title }}</p></a>
                        <h6 class="text-theme">Rs. {{ $product->discount_price }}<span class="text-dark small float-end"><del>Rs. {{ $product->price }}</del></span></h6>
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
                        <span class="badge bg-success">
                            {{ $avg_rating = $total_rating/$count }} <i class="fa fa-star" style="font-size: 10px;"> </i>
                        </span>
                        @endif
                        @guest
                            <a href="{{ route('login') }}" class="text-decoration-none float-end"><i class="fa fa-heart-o"></i></a>
                        @endguest
                        @auth
                            <button class="float-end bg-transparent border-0 asdf_wishlist" id="{{ Auth::id() }}_{{ $product->id }}"><i class="fa fa-heart-o wislist_heart_{{ $product->id }}"></i></button>
                        @endauth
                        {{-- <i class="fa fa-heart wislist_heart_{{ $product->id }}"></i> --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    @endforeach 
    @endif
    <div class="container-fluid p-0 mt-4">
        <img src="{{ asset('assets/images/covid-strip.webp') }}" style="object-fit:fill;" alt="delivery" class="img-fluid">
    </div>
@endsection