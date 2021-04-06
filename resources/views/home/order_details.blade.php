@extends('layouts.base')
<style>
  /* progress bar */
#progressbar {
  margin-bottom: 30px;
  overflow: hidden;
  color: #455A64;
  padding-left: 0px;
  margin-top: 30px
}

#progressbar li {
  list-style-type: none;
  font-size: 13px;
  width: 33.33%;
  float: left;
  position: relative;
  font-weight: 400;
  color: #455A64 !important
}

#progressbar #step1:before {
  content: "1";
  color: #fff;
  width: 29px;
  margin-left: 15px !important;
  padding-left: 11px !important
}

#progressbar #step2:before {
  content: "2";
  color: #fff;
  width: 29px
}

#progressbar #step3:before {
  content: "3";
  color: #fff;
  width: 29px;
  margin-right: 15px !important;
  padding-right: 11px !important
}

#progressbar li:before {
  line-height: 29px;
  display: block;
  font-size: 12px;
  background: #455A64;
  border-radius: 50%;
  margin: auto
}

#progressbar li:after {
  content: '';
  width: 121%;
  height: 2px;
  background: #455A64;
  position: absolute;
  left: 0%;
  right: 0%;
  top: 15px;
  z-index: -1
}

#progressbar li:nth-child(2):after {
  left: 50%
}

#progressbar li:nth-child(1):after {
  left: 25%;
  width: 121%
}

#progressbar li:nth-child(3):after {
  left: 25% !important;
  width: 50% !important
}

#progressbar li.active:before,
#progressbar li.active:after {
  background: #ff1744;
}
</style>


@section('content')
    <div class="container my-5 mb-3">
        <div class="col-lg-12 p-4 bg-white mat-shadow-sm">
            <h6 class="h5 text-dark">Delivery Address</h6>
            <h6 class="text-dark">{{ $order->orders->add->name }}</h6>
            <p class="small text-dark" style="margin-top: -8px; line-height: 1.9;">{{ $order->orders->add->street }}, {{ $order->orders->add->city }} - {{ $order->orders->add->pincode }}, {{ $order->orders->add->state }}.</p>
            <p class="text-dark" style="margin-top: -18px;"><strong>Phone number</strong> : {{ $order->orders->add->contact }}</p>
        </div>
    </div>
    <div class="container px-4 mb-4">
        <div class="row mat-shadow-sm my-2 bg-white">
            <div class="col-lg-4 ">
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
                     <i class="fa fa-circle text-warning"></i> Placed
                     <p style="font-size: 12px; margin-top:-15px;">Your item has been waiting for processed</p>
                 @elseif($order->status == 1)
                     <i class="fa fa-circle text-warning"></i> Processing
                     <p style="font-size: 12px; margin-top:-15px;">Your item has been waiting for processed</p>
                 @elseif($order->status == 2)
                     <i class="fa fa-circle text-theme"></i> Shipped
                     <p style="font-size: 12px; margin-top:-15px;">Your item has been shipped</p>
                 @elseif($order->status == 3)
                     <i class="fa fa-circle text-danger"></i> Cancelled
                     <p style="font-size: 12px; margin-top:-15px;">As per your request, Your item has been delivered</p>
                 @elseif($order->status == 4)
                     <i class="fa fa-circle text-success"></i> Delivered
                     <p style="font-size: 12px; margin-top:-15px;">Your item has been delivered</p>
                 @endif</p>
            </div>
        </div>
    </div>
@endsection