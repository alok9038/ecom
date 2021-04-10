@extends('layouts.base')
@section('content')
    {{-- post items --}}
    @if(count($products) != 0)
        
    
    <div class="container my-5">
        <div class="head text-center">
            @if(isset($_GET['search']))
                <h4 class="fw-light text-center">Search Results for: {{ $_GET['search'] }}<br> <img src="{{ asset('star.jpg') }}" alt="" class="img-fluid" style="width: 360px;"></h4>
            @else
                <h4 class="fw-light text-center">{{ $products[0]->cat->cat_title }} <br> <img src="{{ asset('star.jpg') }}" alt="" class="img-fluid" style="width: 360px;"></h4>
            @endif
        </div>
        <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3">
            @foreach ($products as $product)
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
                            {{ $avg_rating = $total_rating/$count }} <i class="fa fa-star"> </i>
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
    @else
    <div class="container pt-5 mb-5">
        @if(isset($_GET['search']))
            <h4 class="fw-light text-center ">Search Results for: {{ $_GET['search'] }}<br> <img src="{{ asset('star.jpg') }}" alt="" class="img-fluid" style="width: 360px;"></h4>
        @endif
        <div class="row my-5">
            <div class="col-lg-5 mx-auto">
            <h5 class="text-center font-weight-light text-muted">No Products Found!</h5>
            @if(!isset($_GET['search']))
            <p class="text-center small text-muted">Please Try with another category :)</p>
            @endif
            </div>
        </div>
    </div>
    @endif

    {{-- post items end --}}
@endsection