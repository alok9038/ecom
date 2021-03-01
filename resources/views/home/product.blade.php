@extends('layouts.base')
@section('content')
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> --}}
    {{-- <script src="https://wp.incredibbble.com/writsy-shop/wp-content/themes/writsy-shop/assets/vendor/jquery-zoom/jquery.zoom.min.js?ver=1.7.18"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script> 
--}}

    <div class="container" style="margin-top: 30px">
        <div class="container px-2">
            <nav class="" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb bg-white py-3 ps-3 rounded-0 shadow-sm">
                  <li class="breadcrumb-item "><a href="{{ route('homepage') }}" class="text-muted text-decoration-none">Home</a></li>
                  <li class="breadcrumb-item " aria-current="page"><a href="" class="text-decoration-none text-muted">Category</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-5 mb-4 p-0">
                <div class="slider-wrapper ">
                    <div class="slider-for" style="height: auto">
                        @php
                            $images = explode(",",$product->images);
                        @endphp
                        @foreach ($images as $image)
                        <div class="slider-for__item p-0" data-src="{{ asset('product/'.$image) }}">
                            <img src="{{ asset('product/'.$image) }}" class="img-fluid border" style="height:400px;" alt="" />
                          </div>
                        @endforeach
                      
                      

                    </div>
                  
                    <div class="slider-nav px-3">
                        @foreach ($images as $image)
                      <div class="slider-nav__item m-1">
                        <img src="{{ asset('product/'.$image) }}" class="border img-fluid h-100" alt="" />
                      </div>
                      @endforeach
                    </div>
                  </div>        
            </div>    
            <div class="col-lg-7 px-3">
                <h1 class="h4">{{ $product->title }}</h1> 
                <p class="small">Soft toys</p> 
                <p class="h5 text-danger">₹. {{ $product->discount_price }}/- <del class="ms-2 text-muted small">₹. {{ $product->price }}/-</del></p>
                <span class="badge bg-green rounded-0 py-2 mt-3">
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
                <div class="d-flex mt-4">
                    @auth
                    <form action="{{ route('add.to.cart',['id'=>$product->id]) }}" method="post">
                        @csrf
                        <button class="btn bg-green rounded-0 shadow-none">Add to cart</button>
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
        </div>    
    </div>    

    <div class="container mt-5 px-3" id="details">
        <div class="card rounded-0" >
            <div class="card-header rounded-0 ">Product Description</div>
            <div class="card-body">
                <p class="">{{ $product->description }}</p>
            </div>
        </div>        
    </div>

    <div class="container px-3 my-5 ">
        <div class="head p-0 m-0" style="border-bottom: 4px solid #ff1744;">
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
