{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}
@extends('layouts.base')
@section('content')
    <div class="container my-5 py-5 pt-2" >
        <div class="row pb-4">
            <div class="col-lg-5 mx-auto">
                <div class="card border-0 mat-shadow" style="height:calc(550px - 200px)!important;">
                    <div class="card-body ">
                        <h4 class="h5 text-dark text-center">Sign in to your account</h4>
                        <hr>
                        @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="contact" class="text-dark">Email or Phone</label>
                                <input type="contact" class="form-control rounded-3 shadow-none border-secondary" name="email" value="{{ old('contact') }}" required autofocus >
                            </div>
                            <div class="mb-3">
                                <label for="" class="text-dark">Password</label>
                                <input type="password" class="form-control rounded-3 shadow-none border-secondary" name="password" required autocomplete="current-password">
                            </div>
                            @if (Route::has('password.request'))
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label small text-dark" for="flexCheckDefault">
                                  Remember me
                                </label>
                            </div>
                            @endif  
                            <div class="mb-3 mt-2 d-flex">
                                <a href="" class="small mt-3">forgot password?</a>
                                <button class="btn btn-dark ms-auto px-5">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection