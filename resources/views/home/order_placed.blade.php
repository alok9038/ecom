@extends('layouts.base')
@section('content')
<style>
    *{
        color: black;
    }
</style>
<div class="container my-5">
    <div class="container">
        <div class="row mat-shadow py-3">
            <div class="col-lg-8 d-flex">
                <img src="https://static-assets-web.flixcart.com/www/linchpin/fk-cp-zion/img/orderPlacedV2_cb4f64.png" class="img-fluid" style="height: 80px; " alt="">
                <div class=" mt-4 ms-3">
                    <h4>Order placed for ₹ <?php $sum= 0;   foreach($order as $i):   $sum+= $i->items->discount_price*$i->qty;  endforeach;  ?>{{ $sum }}!</h4>
                    <p class="small">Your {{ count($order) }} item will be delivered as soon as possible.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <h6>Why call? Just click!</h6>
                <p class="small">Easily track all your Flipkart orders!</p>
                <a href="{{ route('my.orders') }}" class="btn btn-info px-3">Go to My Orders</a>
            </div>
        </div>

        <div class="row mt-4  mat-shadow">
            <div class="col-lg-6 border-end">
                @foreach ($order as $item)
                <div class="d-flex p-4" style="border-style: none none dashed none; border-width:1px; border-color:lightgrey;">
                    <img src="{{ asset('product/'.$item->items->cover_image) }}" class="img-fluid mat-shadow" style="height: 80px; border-radius:25px; " alt="">
                    <div class="ms-3">
                        <p class="small">{{ $item->items->title }}</p>
                        <p style="margin-top: -20px; font-size:12px;">{{ $item->items->cat->cat_title }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-lg-3 py-4">
                <h6 class="h5">Delivery Address</h6>
                <h6>{{ $order[0]->orders->add->name }}</h6>
                <p class="small" style="margin-top: -8px; line-height: 1.9;">{{ $order[0]->orders->add->street }}, {{ $order[0]->orders->add->city }} - {{ $order[0]->orders->add->pincode }}, {{ $order[0]->orders->add->state }}.</p>
                <p style="margin-top: -18px;"><strong>Phone number</strong> : {{ $order[0]->orders->add->contact }}</p>
            </div>
        </div>
    </div>
</div>
</div>
@endsection