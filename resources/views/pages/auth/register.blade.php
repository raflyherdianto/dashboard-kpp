@extends('layouts.app')
@section('title', 'Register')
@section('content')
<div class="card">
    <div class="card-body">
        <!-- Logo -->
        <div class="app-brand justify-content-center">
            <a href="index.html" class="app-brand-link gap-2">
                <img src="{{ asset('assets/img/logo.png')  }}" alt="" class="w-px-40 h-auto ">
                <span class="app-brand-text demo text-body fw-bolder" style="text-transform: capitalize">{{ config('app.name') }}</span>
            </a>
        </div>
        <!-- /Logo -->
        <h4 class="mb-2">Welcome to {{ config('app.name') }}! 👋</h4>
        <p class="mb-4">Please sign-in to your account and start the adventure</p>

        <form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name')
                    is-invalid
                @enderror" id="name" value="{{ old('name') }}" name="name" placeholder="Enter your name" autofocus />
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email')
                    is-invalid
                @enderror" id="email" value="{{ old('email') }}" name="email" placeholder="Enter your email"
                    autofocus />
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                </div>
                <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control @error('password')
                    is-invalid
                @enderror" name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password" />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                    <label class="form-label" for="password_confirmation">Password Confirmation</label>
                </div>
                <div class="input-group input-group-merge">
                    <input type="password" id="password_confirmation" class="form-control @error('password_confirmation')
                    is-invalid
                @enderror" name="password_confirmation"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password" />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    @error('password_confirmation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Sign up</button>
            </div>
            <p class="text-center">
                <span>Already have an account?</span>
                <a href="{{ route('login') }}">
                    <span>Sign in instead</span>
                </a>
            </p>
        </form>
    </div>
</div>
@endsection
