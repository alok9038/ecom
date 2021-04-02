@extends('layouts.adminbase')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 pb-5 mx-auto">
                <div class="card border">
                    <div class="card-header bg-light">
                        <div class="row">
                            <div class="col-4 h5"><h5 class="text-start ">Orders Detail</h5></div>
                            <div class="col-8">
                                <h5 class="text-end small mt-4">Order id : #{{ $order->id }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table  table-borderless table-stripped">
                            <tr class="table w-100">
                                <th style="width: 400px;">Product</th>
                                <th>Price</th>
                                <th>Discount Price</th>
                                <th>Qty</th>
                                <th>Status</th>
                            </tr>
                            
                            <tr>
                                <td class="d-flex">
                                    <div class="bg-white " style="height: 185px; width:185px; border-radius:25px; box-shadow: rgb(0 0 0 / 20%) 0px 3px 1px -2px, rgb(0 0 0 / 14%) 0px 2px 2px 0px, rgb(0 0 0 / 12%) 0px 1px 5px 0px;">
                                        <img src="{{ asset('product/'.$order->items->cover_image) }}" alt="" class="img-fluid" style="height: 175px; width:175px;margin-top:0.3rem; margin-left:0.3rem; border-radius:20px; ">
                                    </div>
                                    <div class="">
                                        <h6 class="text-truncate ms-2 mt-2">{{ substr($order->items->title, 0, 30) }}..</h6>
                                        <p class="small ms-2">{{ $order->items->cat->cat_title }}</p>
                                    </div>
                                </td>
                                <td>₹ {{ $order->items->price }}</td>
                                <td>₹ {{ $order->items->discount_price }}</td>
                                <td>{{ $order->qty }}</td>
                                {{-- <td>
                                    <form action="{{ route('check_requirement',['id'=>$order->id]) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-warning rounded-0 btn-sm">Shipped</button>
                                    </form>
                                </td> --}}
                                <td>
                                    @if ($order->status == 0)
                                        <span class="badge bg-info">pending</span>
                                    @elseif($order->status == 1)
                                        <span class="badge bg-warning">Processing</span>
                                    @elseif($order->status == 2)
                                        <span class="badge bg-info">shipped</span>
                                    @elseif($order->status == 3)
                                        <span class="badge bg-danger">cancelled</span>
                                    @elseif($order->status == 4)
                                        <span class="badge bg-success">Delivered</span>
                                    @endif
                                <td>
                                    
                            </tr>
                            <tr>
                                <td class="pt-4"><strong class="me-3">Address :</strong>{{ $order->orders->add->street }} ,<br>{{$order->orders->add->city }} - {{ $order->orders->add->pincode .' , '. $order->orders->add->state }}</td>
                                @if ($order->status == 2)
                                    <td colspan="3" class="pt-4">
                                        <a href="{{ $print->invoice_url }}" target="_blank" class="btn btn-info float-end"><i class="fa fa-print"></i> Print Invoice</a>
                                    </td>
                                    <td class="pt-4" colspan="">
                                        <form action="{{ route('cancel_order',['id'=>$order->ship_order_id]) }}" method="post">
                                            @csrf
                                            <button class="btn btn-danger " type="submit" name="cancel_order"><i class="fa fa-trash"></i> Cancel Order</button>
                                        </form>
                                    </td> 
                                    <td class="pt-4" colspan="">
                                        <form action="{{ route('generate_awb') }}" method="post">
                                            @csrf
                                            <button class="btn btn-warning " type="submit" name="cancel_order"><i class="fa fa-box"></i> Generate AWB</button>
                                        </form>
                                    </td> 

                                @endif
                            </tr>
                            <tr>
                                <td class="pt-3"><strong class="me-3">
                                    Order Status :</strong> 
                                    @if ($order->status == 0)
                                        <span class="badge bg-info">pending</span>
                                    @elseif($order->status == 1)
                                        <span class="badge bg-warning">Processing</span>
                                    @elseif($order->status == 2)
                                        <span class="badge bg-info">shipped</span>
                                    @elseif($order->status == 3)
                                        <span class="badge bg-danger">Cancelled</span>
                                    @elseif($order->status == 4)
                                        <span class="badge bg-success">Delivered</span>
                                    @endif</td>
                            </tr>
                        </table>
                        <form action="{{ route('create_order',['id'=>$order->id]) }}" method="post">
                            @csrf
                            <div class="mb-3 pe-4">
                                <select name="update_order_status" required onchange="select_status()" id="update_order_status" class="form-control">
                                    
                                    @if ($order->status == 0)
                                        <option value="0" selected disabled hidden>Pending</option>
                                        <option value="1">Processing</option>
                                        <option value="2">Shipped</option>
                                        <option value="3">Cancelled</option>
                                        <option value="4">Delivered</option>
                                    @elseif($order->status == 1)
                                        <option value="0" >Pending</option>
                                        <option value="1" selected disabled >Processing</option>
                                        <option value="2">Shipped</option>
                                        <option value="3">Cancelled</option>
                                        <option value="4">Delivered</option>
                                    @elseif($order->status == 2)
                                        <option value="0" >Pending</option>
                                        <option value="1">Processing</option>
                                        <option value="2" selected disabled >Shipped</option>
                                        <option value="3">Cancelled</option>
                                        <option value="4">Delivered</option>
                                    @elseif($order->status == 3)
                                        <option value="0" >Pending</option>
                                        <option value="1">Processing</option>
                                        <option value="2"  >Shipped</option>
                                        <option value="3" selected disabled>Cancelled</option>
                                        <option value="4">Delivered</option>
                                    @elseif($order->status == 4)
                                        <option value="0" >Pending</option>
                                        <option value="1">Processing</option>
                                        <option value="2" >Shipped</option>
                                        <option value="3">Cancelled</option>
                                        <option value="4" selected disabled>Delivered</option>
                                    @endif
                                </select>
                            </div>
                            <div class="row mb-3 pe-4" id="shipped_box" style="display: none;">
                                <div class="col">
                                    <input type="text" name="length" required placeholder="Length" class="form-control">
                                </div>
                                <div class="col">
                                    <input type="text" name="height" required placeholder="height" class="form-control">
                                </div>
                                <div class="col">
                                    <input type="text" name="width" required placeholder="width" class="form-control">
                                </div>
                                <div class="col">
                                    <input type="text" name="weight" required placeholder="Weight" class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 pe-4">
                                <input type="submit" name="place_order" class="btn btn-info w-100">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function select_status(){
            var update_order_status = jQuery('#update_order_status').val();
            if(update_order_status == 2){
                jQuery('#shipped_box').show();
            }
        }
    </script>
@endsection