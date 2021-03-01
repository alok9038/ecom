@extends('layouts.adminbase')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="card border">
                    <div class="card-header bg-light">
                        <div class="row">
                            <div class="col-8">
                                <form action="" class="d-flex">
                                    <div class="input-group shadow-sm">
                                        <div class="input-group-prepend">
                                            <button class="btn bg-white rounded-0 text-dark border-0"><i class="fa fa-search"></i></button>
                                        </div>
                                        <input type="search" name="search" id="" class="form-control rounded-0 shadow-none bg-white border-0 text-dark" placeholder="search products">
                                    </div>
                                </form>
                            </div>
                            <div class="col-4 h5 pt-1"><h5 class="text-end ">Orders</h5></div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover table-borderless table-stripped">
                            <tr class="table-dark w-100">
                                <th>Order Id</th>
                                <th>Product</th>
                                <th>Discount Price</th>
                                <th>Qty</th>
                                <th>Order Date</th>
                                <th>Status</th>
                            </tr>
                            
                            @foreach ($orders as $order)
                                <tr role="button" data-href="{{ route('orders.details.view',['id'=>$order->id]) }}">
                                    <td>#{{ $order->id }}</td>
                                    <td class="d-flex">
                                        <div class="bg-white " style="height: 85px; width:85px; border-radius:25px; box-shadow: rgb(0 0 0 / 20%) 0px 3px 1px -2px, rgb(0 0 0 / 14%) 0px 2px 2px 0px, rgb(0 0 0 / 12%) 0px 1px 5px 0px;">
                                            <img src="{{ asset('product/'.$order->items->cover_image) }}" alt="" class="img-fluid" style="height: 75px; width:75px;margin-top:0.3rem; margin-left:0.3rem; border-radius:20px; ">
                                        </div>
                                        <div class="">
                                            <h6 class="text-truncate ms-2 mt-2">{{ substr($order->items->title, 0, 30) }}..</h6>
                                            <p class="small ms-2">{{ $order->items->cat->cat_title }}</p>
                                        </div>
                                    </td>
                                    <td>₹ {{ $order->items->discount_price }}</td>
                                    <td>{{ $order->qty }}</td>
                                    <td>
                                        @php
                                            $date = strtotime($order->created_at)
                                        @endphp
                                        {{ date('d-m-Y', $date) }}</td>
                                    <td>
                                        @if ($order->status == 0)
                                            <span class="badge bg-info">pending</span>
                                        @elseif($order->status == 1)
                                            <span class="badge bg-warning">Processing</span>
                                        @elseif($order->status == 2)
                                            <span class="badge bg-info px-3">shipped</span>
                                        @elseif($order->status == 3)
                                            <span class="badge bg-danger">Cancelled</span>
                                        @elseif($order->status == 4)
                                            <span class="badge bg-success">Delivered</span>
                                        @endif
                                    <td>
                                    
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <script>
        $(function(){
            $(".table").on("click", "tr[role=\"button\"]", function (e) {
                window.location = $(this).data("href");
            });
        });

    </script>
@endsection