@extends('layouts.base')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-lg-12 mx-auto ">
            <div class="card border-0 mat-shadow-sm">
            <form action="{{ route('insert.address') }}" class="available_add" method="post">
                <div class="card border-0 shadow">
                    @foreach($address as $pata)
                    <div class="card-body">
                        <div class="form-check">
                            <input type="radio"  onclick="this.form.submit()" class="form-check-input" id="{{ $pata->id }}"
                                value=" {{ $pata->id }}" name="address">
                            <label class="form-check-label" for="{{ $pata->id }}">
    
                                <h4 class="h5 "> {{ $pata->name }}</h4>
                                <h5 class="h6 small">+91 {{ $pata->contact }}</h5>
                                <h5 class="h6 small">{{ $pata->email }}</h5>
                                <p>{{ $pata->street }},  {{ $pata->city }}, {{ $pata->pincode }}</p>
                                <p class="mt-n3">{{ $pata->state }}</p class="small">
                            </label>
                        </div>
                    </div>
                    @endforeach
                    <script>
                        $('input[type=radio]').click(function() {
                            $(".available_add").submit();
                        });
                    </script>
            
            <div class="card-header border-bottom bg-white">Add New Address</div>
                <div class="card-body">
                    <form action="{{ route('insert.address') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" id="" class="form-control" value="{{ $user->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="">Contact</label>
                            <input type="texts" name="contact" id="" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="texts" name="email" id="" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label for="">Street</label>
                            <input type="text" name="street" id="" class="form-control" value="">
                        </div>
                    
                        <div class="mb-3">
                            <label for="">City</label>
                            <input type="text" name="city" id="" class="form-control" value="">
                        </div>
                    
                        <div class="mb-3">
                            <label for="">State</label>
                            <input type="text" name="state" id="" class="form-control" value="">
                        </div>
                    
                        <div class="mb-3">
                            <label for="">Pincode</label>
                            <input type="text" name="pincode" id="" class="form-control" value="">
                        </div>
                    
                        <div class="mb-3">
                            <label for="">Landmark</label>
                            <textarea type="text" name="landmark" rows="5" cols="5" class="form-control" value=""></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="submit" class="btn btn-success w-100">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection