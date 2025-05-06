@extends('landing_page.layouts.master')
@section('content')
<style>
    .logpage {
        background-image: url({{ asset('landing/img/cat_football.jpg') }});
    }
    .card {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        margin-top: 150px;
        margin-bottom: 120px;
    }

    .card-header {
        background-color: #f8f9fa;
        font-size: 1.25rem;
        font-weight: bold;
        text-align: center;
    }

    .card-body {
        display: flex;
        padding: 2rem;
    }

    .form-container, .image-container {
        flex: 1;
        margin: 1rem;
    }

    .form-control {
        border-radius: 5px;
        border: 1px solid #ced4da;
    }

    .image-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        padding: 0;
        margin: -32px;
    }

    .image-container img {
        max-width: 100%;
        height: auto;
        border-radius: 10px 0 10px 10px;
        display: block;
    }

    .btn-primary {
        background-color: #00d084;
        border-color: #00d084;
    }

    .btn-primary:hover {
        background-color: #00b56d;
        border-color: #00b56d;
    }

    .invalid-feedback {
        color: #dc3545;
    }

    .register-link {
        text-align: center;
        margin-top: 15px;
    }

    .register-link a {
        color: #00d084;
        text-decoration: none;
        font-weight: bold;
    }

    .register-link a:hover {
        text-decoration: underline;
    }
</style>
<div class="logpage">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>
                    <div class="card-body">
                        <div class="form-container">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                            <div class="register-link">
                                <p>
                                    {{ __("Don't have an account?") }}
                                    <a href="{{ route('register') }}">{{ __('Register Here') }}</a>
                                </p>
                            </div>
                        </div>
                        <div class="image-container">
                            <img src="{{ asset('landing/img/cat_football.jpg') }}" alt="Login Image" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
