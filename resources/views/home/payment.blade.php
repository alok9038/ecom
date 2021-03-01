@extends('layouts.homebase')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-4 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('payment') }}" method="post">
                            @csrf
                            <div class="form-check">
                                <input type="radio" class="form-check-input" value="1" id="materialUnchecked"
                                    name="mode">
                                <label class="form-check-label" for="materialUnchecked">Cash on Delivery</label>
                            </div>
                            <div class="form-check my-3">
                                <input type="radio" class="form-check-input" value="0" id="materialchecked"
                                    name="mode">
                                <label class="form-check-label" for="materialchecked">Online Payment</label>
                            </div>

                            <div class="">
                                <input type="submit" value="Pay" class="btn btn-danger ">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection