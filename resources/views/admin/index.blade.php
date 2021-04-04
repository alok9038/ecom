@extends('layouts.adminbase')
@section('content')
@parent
{{-- {{ session()->get('utype') }} --}}

    <div class="container px-5 pt-1" style="margin-top: -50px">
        <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 row-cols-sm-2">
            <div class="col mb-4">
                <div class="card border-0 bg-white shadow">
                    <div class="card-body">
                        <p class="text-muted">Today's Orders</p> <span class="badge bg-primary rounded-3 float-end p-2"> <i class="fa fa-shopping-bag"></i></span>
                        <h5>{{ $new_order }}</h5>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card border-0 bg-white shadow">
                    <div class="card-body">
                        <p class="text-muted">New Orders</p> <span class="badge bg-primary rounded-3 float-end p-2"> <i class="fa fa-shopping-bag"></i></span>
                        <h5>{{ $new_order }}</h5>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card border-0 bg-white shadow">
                    <div class="card-body">
                        <p class="text-muted">Today's Revenue</p> <span class="badge bg-warning rounded-3 float-end p-2"> <i class="fa fa-dollar"></i></span>
                        <h5>{{ $orders }}</h5>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card border-0 bg-white shadow">
                    <div class="card-body">
                        <p class="text-muted">Total Orders</p> <span class="badge bg-warning rounded-3 float-end p-2"> <i class="fa fa-shopping-bag"></i></span>
                        <h5>{{ $orders }}</h5>
                    </div>
                </div>
            </div>
            {{-- <div class="col mb-4">
                <div class="card border-0 bg-white shadow">
                    <div class="card-body">
                        <p class="text-muted">Cancelled Orders</p> <span class="badge bg-danger rounded-3 float-end p-2"> <i class="fa fa-shopping-bag"></i></span>
                        <h5>{{ $cancelled_orders }}</h5>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card border-0 bg-white shadow">
                    <div class="card-body">
                        <p class="text-muted">Total Users</p> <span class="badge bg-info rounded-3 float-end p-2"> <i class="fa fa-user"></i></span>
                        <h5>149</h5>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card border-0 bg-white shadow">
                    <div class="card-body">
                        <p class="text-muted">Total Category</p> <span class="badge bg-danger rounded-3 float-end p-2"> <i class="fa fa-th-large"></i></span>
                        <h5>{{ $category }}</h5>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card border-0 bg-white shadow">
                    <div class="card-body">
                        <p class="text-muted">Total Coupons</p> <span class="badge bg-danger rounded-3 float-end p-2"> <i class="fa fa-th-large"></i></span>
                        <h5>{{ $coupon }}</h5>
                    </div>
                </div>
            </div> --}}
            
        </div>
        
    </div>
@endsection