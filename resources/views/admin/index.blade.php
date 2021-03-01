@extends('layouts.adminbase')
@section('content')
{{ user()->is_admin }}
    <div class="container text-light px-3">
        <div class="card border-0 shadow-sm bg-theme">
            <div class="card-body">
                <h5 class="h3 fw-light">Welcome To Kumar Studio Admin Pannel.</h5>
                <p class="text-white">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nostrum atque laboriosam numquam, accusantium dolor cumque ipsum saepe esse facere, iste illum eveniet quidem voluptates possimus debitis. Labore earum corrupti animi.</p>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 row-cols-sm-2">
            <div class="col mb-4">
                <div class="card border-0 bg-white shadow">
                    <div class="card-body">
                        <p class="text-muted">Total Products</p> <span class="badge bg-success rounded-3 float-end p-2"> <i class="fa fa-eye"></i></span>
                        <h5>{{ $products }}</h5>
                    </div>
                </div>
            </div>
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
                        <p class="text-muted">Total Orders</p> <span class="badge bg-warning rounded-3 float-end p-2"> <i class="fa fa-shopping-bag"></i></span>
                        <h5>{{ $orders }}</h5>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
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
            </div>
        </div>
    </div>
@endsection