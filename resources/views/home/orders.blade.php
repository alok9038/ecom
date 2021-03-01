@extends('layouts.base')
@section('content')
@if (count($order) != 0)
<div class="container-fluid px-3 mt-3 bg-white" style="max-width:98%!important;">
    <div class="row">
        <div class="col-lg-11 mx-auto">
            <div class="card border-0 shadow-none">
            <div class="card-header bg-white border-0"><h3>My Orders</h3></div>
                <div class="card-body border-top">
                @foreach($order as $o)
                    <div class="row border-bottom">
                        <div class="col-lg-3">
                            <div class="card-img p-3" ><img src="{{ asset('product/'.$o->items->cover_image) }}" style="height:200px;" class="img-fluid" alt=""></div>
                        </div>
                        <div class="col-lg-6 py-4">{{ $o->title }}
                            <p class="text-success mt-4">order placed</p>
                        </div>
                        <div class="col-lg-3 text-right py-4"><h6>₹ {{ $o->items->discount_price }}</h6>
                            <p class="small"><del>₹ {{ $o->items->price }}</del></p>
                            <a href="" class="btn btn-info btn-sm px-3">cancel order</a>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="container mt-5 " style="height: 400px;" >
    <div class="col-lg-4 mx-auto col-md-5">
        <div class="card border-0 text-center">
            <h4 class="fw-light">No Orders Yet</h4>
            <p class="">Looks like you haven't made your choice yet..</p>
        </div>
    </div>
</div>
@endif
@endsection