@extends('layouts.adminbase')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('insert.coupon') }}" method="post" >
                        @csrf
                        <div class="mb-3">
                            <label >Coupon Code</label>
                            <input type="text"  name="code" class="form-control rounded-0 shadow-sm">
                        </div>
                        <div class="mb-3">
                            <label >Amount</label>
                            <textarea  class="form-control" name="amount" cols="30" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-info rounded-0 w-100" name="add" value="Add coupon">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <form action="" class="d-flex">
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <button class="btn bg-white rounded-0 text-dark border-0"><i class="fa fa-search"></i></button>
                                    </div>
                                    <input type="search" name="search" id="" class="form-control rounded-0 shadow-none bg-white border-0 text-dark" placeholder="search coupon">
                                </div>
                            </form>
                        </div>
                        <div class="col-4"><a href="#title" class="btn btn-info float-end rounded-0 btn-sm">Add coupon</a></div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-hover">
                        <tr class="table-dark">
                            <th >Sr no</th>
                            <th>Code</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th class="">Action</th>
                        </tr>
                        @php
                            $sr = 0
                        @endphp
                        @foreach ($coupons as $coupon)
                            <tr>
                                <td>{{ $sr +=1 }}</td>
                                <td>{{ $coupon->code }}</td>
                                <td>{{ $coupon->amount }}</td>
                                <td>
                                    @if ($coupon->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Deactive</span>
                                    @endif
                                </td>
                                <td class="d-flex">
                                    <form action="{{ route('coupon.delete',['id'=>$coupon->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger rounded-0 btn-sm"><i class="fa fa-trash"></i></button>
                                    </form>
                                    <form action="{{ route('coupon.delete',['id'=>$coupon->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-info rounded-0 btn-sm"><i class="fa fa-edit"></i></button>
                                    </form>
                                    @if ($coupon->status == 1)
                                    <form action="{{ route('coupon.status',['id'=>$coupon->id]) }}" method="post">
                                        @csrf
                                        <button type="submit" name="deactive" class="btn btn-danger ms-3 rounded-0 btn-sm">Deactivate</button>
                                    </form>
                                    @else
                                    <form action="{{ route('coupon.status',['id'=>$coupon->id]) }}" method="post">
                                        @csrf
                                        <button type="submit" name="active" class="btn btn-success ms-3 px-4 rounded-0 btn-sm">Active</button>
                                    </form>                                 
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection