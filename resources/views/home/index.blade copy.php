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
        height: 101px; 
        width: 101px!important;
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
    {{--banner section  --}}
    {{-- <div class="container-fluid bg-dark pb-5 px-0 home-img" style="background-image:url({{ asset("hero.jpg") }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col mt-5">
                    <div class="card border-0 text-white shadow-sm rounded-0" style="backdrop-filter: blur(10px); background-color:rgba(2, 2, 2, 0.336);">
                        <div class="card-body">
                            <h1 class="fw-light">Personalized Gifts</h1>
                            <p class="lead">Make the one you love the most by treating them with something super special.</p>
                            <h2 class="">Flat 10% Discount</h2>
                            <a href="" class="btn btn-outline-light float-end rounded-0 shadow-none">Show Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    
    <div class="container-fluid">
        <div class="mx-auto">
            <section class="top-offer w-100 slider mt-3">      
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
                <div class="slide py-2 category-slider" style="height: auto; outline:none;">
                    <div class="card bg-transparent border-0">
                        <div class="card-body cat p-1 bg-dark rounded-circle d-flex justify-content-center mat-shadow-sm category-card">
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
    <div class="container mt-4 categories">
        <div class="head text-center"><h4 class="fw-light text-center">Categories <br> <img src="{{ asset('star.jpg') }}" alt="" class="img-fluid" style="width: 360px;"></h4></div>
        <section class="customer-logos slider mt-4">
            @php
                $category = category()
            @endphp
            @foreach ($category as $cat)
            <div class="slide">
              <div class="card border-0" style="border-radius:25px;">
                  <div class="" style="border-radius:50%; background-color:{{ $cat->color }}; padding:2px;">
                    <img src="{{ asset('category/'.$cat->image) }}" style="border-radius:50%;" class="img-fluid" alt="">
                  </div>
                  <div class="card-body">
                      <h6 class="text-center small text-truncate">{{ $cat->cat_title }}</h6>
                      <a href="{{ route('filter',['name'=>$cat->slug]) }}" title="{{ $cat->cat_title }}" class="stretched-link"></a>
                  </div>
              </div>
            </div>
            @endforeach   
        </section>
        <div class="paginator">
            <div class="mx-auto text-center" style="width: auto;">
                <span class="prev me-3 p-1"><i class="fas fa-2x fa-arrow-left"></i></span>
                <span class="next ms-3"><i class="fas fa-2x fa-arrow-right"></i></span>
            </div>
        </div>
    </div>
    {{-- category section end --}}

    {{-- post items --}}
    <div class="container my-5">
        <div class="head text-center"><h4 class="fw-light text-center">Latest Collections <br> <img src="{{ asset('star.jpg') }}" alt="" class="img-fluid" style="width: 360px;"></h4></div>
        <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3">
            @foreach ($products as $product)
                <div class="col mb-4">
                    <div class="card border-0 shadow-sm post-item" style="border-radius: 5px;">
                        <img src="{{ asset('product/'.$product->cover_image) }}" style="height: 266px; object-fit:cover; object-position:center;" alt="" class="img-fluid card-img-top">
                        <div class="card-body">
                            <a href="{{ route('home.product',['name'=>$product->slug]) }}" class="stretched-link text-decoration-none text-dark"><h6 class="text-truncate">{{ $product->title }}</h6></a>
                                <p class="h6 text-theme mt-2">₹. {{ $product->discount_price }}/- <del class="ms-2 text-muted small">₹. {{ $product->price }}/-</del></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- post items end --}}
    
@endsection