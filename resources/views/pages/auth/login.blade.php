@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="card">
    <div class="card-body">
        <!-- Logo -->
        <div class="app-brand justify-content-center">
            <a href="index.html" class="app-brand-link gap-2">
                <img src="{{ asset('assets/img/logo.png')  }}" alt="" class="w-px-40 h-auto ">
                <span class="app-brand-text demo text-body fw-bolder"
                    style="text-transform: capitalize">{{ config('app.name') }}</span>
            </a>
        </div>
        <!-- /Logo -->
        <h4 class="mb-2">Welcome to {{ config('app.name') }}! 👋</h4>
        <p class="mb-4">Please sign-in to your account and start the adventure</p>

        <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">email</label>
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
            <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
            </div>
            <p class="text-center">
                <span>New on our platform?</span>
                <a href="{{ route('register') }}">
                    <span>Create an account</span>
                </a>
            </p>
        </form>
    </div>
</div>
@endsection
