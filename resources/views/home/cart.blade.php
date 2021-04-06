
@extends('layouts.base')
@section('content')
<style>
    .card-footer{
        -webkit-box-shadow:0 -0.5rem 1.10rem rgba(0,0,0,.075)!important;
    -moz-box-shadow:0 -0.5rem 1.10rem rgba(0,0,0,.075)!important;
    box-shadow:0 -0.5rem 1.10rem rgba(0,0,0,.075)!important;
    }
    .border-dotted{
    border-style: dashed!important;
    border-top:2px rgb(0 0 0 / 50%);
    border-bottom:0;
    border-left:0;
    border-right:0;
    }
    @media (max-width: 1068px) {
        .col-lg-4{
            position:relative!important;
            bottom:0!important;
            right:0!important;
        }
    }
    

</style>

<div class="container mb-5 mt-0">

    @if (count($items) != 0)
        <div class="row mb-5 ">
            <div class="col-lg-8">
                <div class="card rounded-0 shadow-sm mt-5">
                <div class="card-header bg-white h5">My Cart ({{ count($items) }})</div>
                    <div class="card-body p-0 px-3">
                        @foreach ($items as $item)
                            <div class="row  mt-4 pb-3 border-bottom">
                                <div class="col-lg-3 ">
                                    <div class="h-50 w-100 mb-4">
                                        <img src="{{ asset('product/'.$item->items->cover_image) }}" class="img-fluid border-light w-100 " alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <h4 class="text-truncate h6" title="">{{ $item->items->title }}</h4>
                                    <p class="text-muted small">{{ $item->items->cat->cat_title }}</p>
                                    <h4 class="h6">₹ {{ $item->items->discount_price }}/- <span class="small font-weight-light ml-3 text-muted"><del>₹ {{ $item->items->price }}/-</del></span></h4>                                 
                                </div>
                                <div class="col-lg-3">
                                    <div class="box btn-group">
                                        <form action="{{ route('decrease.items',['id'=>$item->items->id]) }}" method="post">
                                            @csrf
                                            <button class="btn border-0 btn-secondary rounded-0">-</button>
                                        </form>
                                        <a href="" class="btn btn-light  text-dark border disabled rounded-0">{{ $item->qty }}</a>
                                        <form action="{{ route('add.to.cart',['id'=>$item->items->id]) }}" method="post">
                                            @csrf
                                            <button class="btn border-0 btn-secondary rounded-0">+</button>
                                        </form>
                                    </div>
                                    <div class="box mt-3">
                                        <a href="{{ route('remove.item',['id'=>$item->items->id]) }}" class="text-muted small text-decoration-none"> <i class="fa fa-trash"></i>  Remove</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-lg-4 mb-5">
                <div class="card mt-5 rounded-0 shadow-sm ">
                    <div class="card-header h5 bg-white text-muted">Order Summary</div>
                    <div class="card-body">
                        <table class="table-md table table-borderless">
                            <tr>
                                <td>Subtotal ( @if(count($items) == 1 ) {{ count($items) }} item) @else {{ count($items) }} items )@endif</td>
                                <?php $sum= 0;   foreach($items as $i):   $sum+= $i->items->discount_price*$i->qty;  endforeach;  ?>
                                <td>₹ {{ $sum }}</td>
                            </tr>
                            <tr>
                                @if(!empty($order->coupon))
                                <td class="">Coupon Discount</td>
                                <td class="">- ₹ {{  $order->coup->amount }}</td>
                                @endif
                            </tr>
                            <tr class="">
                                <td >Shipping</td>
                                <td class="text-success-2 pb-5">Free</td>
                            </tr>
                            <tr class="border-dotted">
                                <th class="">Total amount</th>
                                
                                <th class="">₹ 
                                    @if (!empty($order->coupon))
                                        {{ $sum - $order->coup->amount }}
                                    @else
                                        {{ $sum }}
                                    @endif
                                </th>
                                
                            </tr>
                        </table>
                        <form action="{{ route('coupon') }}" class="mt-3" method="post">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="order_id" hidden value="{{ $item->order_id }}">
                                <input type="text" name="total_amount" hidden value="{{ $sum }}">
                                <input type="search" name="code" placeholder="Enter coupon code" class="form-control shadow-none rounded-0">
                                <div class="input-group-append">
                                    <input type="submit" value="Apply" class="btn btn-info rounded-0">
                                </div>
                            </div>
                        </form>

                            @if (!empty($order->coupon))
                                <h6 class="mt-3 text-success-2">
                                    <a href="{{ route('coupon.remove',['id'=>$order->id]) }}" class="text-theme"><i class="fa fa-trash"></i></a> <strong>{{ $order->coup->code }}</strong> <small>Applied</small>
                                </h6>
                            @endif
                        
                        <a href="{{ route('checkout') }}" class="btn btn-success text-white rounded-0 w-100 mat-shadow-sm mt-4">Checkout</a>
                        <a href="{{ route('homepage') }}" class="text-decoration-none text-info small float-end mt-3">Continue shopping.</a>
                    </div>            
                </div>
            </div>
            
        </div>
    @else

        <div class="container pt-5">
            <div class="row mt-5">
                <div class="col-lg-5 mx-auto">
                <h6 class="text-center"><img src="{{ asset('emptyc.png') }}" style="width:100%" alt=""></h6>
                <h5 class="text-center font-weight-light text-muted">Your cart is empty!</h5>
                <p class="text-center small text-muted">Add Something to make me happy :)</p>
                </div>
            </div>
        </div>
    @endif


</div>
@endsection
    
                    
    
    
    
    
    
    
    
    