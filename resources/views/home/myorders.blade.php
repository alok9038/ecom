@extends('layouts.base')

@section('content')
    @if (count($order) > 0)
    <div class="container my-4 bg-white">
        @foreach ($order as $item)
        <div class="card border-0 my-2 bg-white">
            <a href="{{ route('order.details',['id'=>$item->id]) }}" class="stretched-link"></a>
            <div class="row mat-shadow-sm">
                <div class="col-lg-6">
                     <div class="d-flex p-3" style="">
                         <img src="{{ asset('product/'.$item->items->cover_image) }}" class="img-fluid " style="height: 100px; width:100px; border-radius:3px; " alt="">
                         <div class="ms-3">
                             <p class="small text-dark">{{ $item->items->title }}</p>
                             <p style="margin-top: -20px; font-size:12px;">{{ $item->items->cat->cat_title }}</p>
                         </div>
                     </div>
                </div>
                <div class="col-lg-3 col-2 py-5">
                     <p class="small text-dark fw-bold">₹ {{ $item->items->discount_price }}</p>
                </div>
                <div class="col-lg-3 col py-4">
                     <p class="small fw-bold text-capitalize text-dark"> 
                     @if ($item->status == 0)
                         <i class="fa fa-circle text-warning"></i> Processing
                         <p style="font-size: 12px; margin-top:-15px;">Your item has been waiting for processed</p>
                     @elseif($item->status == 1)
                         <i class="fa fa-circle text-warning"></i> Processing
                         <p style="font-size: 12px; margin-top:-15px;">Your item has been waiting for processed</p>
                     @elseif($item->status == 2)
                         <i class="fa fa-circle text-info"></i> Shipped
                         <p style="font-size: 12px; margin-top:-15px;">Your item has been shipped</p>
                     @elseif($item->status == 3)
                         <i class="fa fa-circle text-danger"></i> Cancelled
                         <p style="font-size: 12px; margin-top:-15px;">As per your request, Your item has been delivered</p>
                     @elseif($item->status == 4)
                         <i class="fa fa-circle text-success"></i> Delivered
                         <p style="font-size: 12px; margin-top:-15px;">Your item has been delivered</p>
                     @endif</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="d-flex align-items-center justify-content-center" style="height: 50vh">
        <h2 class="fw-light h1">No orders Yet!</h2>
    </div>
    @endif
@endsection