@extends('layouts.base')

@section('content')
    <div class="container my-5 mb-3">
        <div class="col-lg-12 p-4 mat-shadow">
            <h6 class="h5 text-dark">Delivery Address</h6>
            <h6 class="text-dark">{{ $order->orders->add->name }}</h6>
            <p class="small text-dark" style="margin-top: -8px; line-height: 1.9;">{{ $order->orders->add->street }}, {{ $order->orders->add->city }} - {{ $order->orders->add->pincode }}, {{ $order->orders->add->state }}.</p>
            <p class="text-dark" style="margin-top: -18px;"><strong>Phone number</strong> : {{ $order->orders->add->contact }}</p>
        </div>
    </div>
    <div class="container px-4 mb-4">
        <div class="row mat-shadow my-2">
            <div class="col-lg-4">
                 <div class="d-flex p-3" style="">
                     <img src="{{ asset('product/'.$order->items->cover_image) }}" class="img-fluid " style="height: 100px; width:100px; border-radius:3px; " alt="">
                     <div class="ms-3">
                         <p class="small text-dark">{{ $order->items->title }}</p>
                         <p style="margin-top: -20px; font-size:12px;">{{ $order->items->cat->cat_title }}</p>
                         <p class="small text-dark fw-bold">₹ {{ $order->items->discount_price }}</p>
                     </div>
                 </div>
            </div>
            <div class="col-lg-5 col-12 py-lg-5">
                <div class="row px-3">
                    <div class="col">
                        <ul id="progressbar">
                            @if ($order->status == 0)
                                <li class="step0 active " id="step1">PLACED</li>
                                <li class="step0 text-center" id="step2">SHIPPED</li>
                                <li class="step0 text-muted text-end" id="step3">DELIVERED</li>
                            @elseif($order->status == 2)
                                <li class="step0 active " id="step1">PLACED</li>
                                <li class="step0 active text-center" id="step2">SHIPPED</li>
                                <li class="step0 text-muted text-end" id="step3">DELIVERED</li>
                            @elseif($order->status == 4)
                                <li class="step0 active " id="step1">PLACED</li>
                                <li class="step0 active text-center" id="step2">SHIPPED</li>
                                <li class="step0 text-muted text-end" id="step3">DELIVERED</li>
                            @elseif($order->status == 3)
                                <li class="step0 active" id="step1">PLACED</li>
                                <li class="step0 active text-center p-0" id="step2">SHIPPED</li>
                                <li class="step0 text-muted active text-end" id="step3">CANCELLED</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col py-4">
                 <p class="small fw-bold text-capitalize text-dark"> 
                 @if ($order->status == 0)
                     <i class="fas fa-circle text-warning"></i> Placed
                     <p style="font-size: 12px; margin-top:-15px;">Your item has been waiting for processed</p>
                 @elseif($order->status == 1)
                     <i class="fas fa-circle text-warning"></i> Processing
                     <p style="font-size: 12px; margin-top:-15px;">Your item has been waiting for processed</p>
                 @elseif($order->status == 2)
                     <i class="fas fa-circle text-theme"></i> Shipped
                     <p style="font-size: 12px; margin-top:-15px;">Your item has been shipped</p>
                 @elseif($order->status == 3)
                     <i class="fas fa-circle text-danger"></i> Cancelled
                     <p style="font-size: 12px; margin-top:-15px;">As per your request, Your item has been delivered</p>
                 @elseif($order->status == 4)
                     <i class="fas fa-circle text-success"></i> Delivered
                     <p style="font-size: 12px; margin-top:-15px;">Your item has been delivered</p>
                 @endif</p>
            </div>
        </div>
    </div>
@endsection