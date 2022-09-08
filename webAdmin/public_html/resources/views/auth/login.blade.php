@extends('layouts.app')
<style>
    @media (min-width: 576px) {
        .login-form {
            width: 56rem !important;
        }
    }

</style>
@section('content')
    <div class="container">
        <div class="content d-flex justify-content-center align-items-center">

            <!-- Login form -->
            <form class="login-form" method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="card mb-0">
                    <div class="card-header"><h4>{{ __('Signal Trading System') }}</h4></div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i
                                class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h5 class="mb-0">Login to your account</h5>
                            <span class="d-block text-muted">Enter your credentials below</span>
                        </div>
                        {{-- user name --}}

                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                placeholder="Username">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                        </div>

                        {{-- password --}}

                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input type="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password" placeholder="Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                        </div>

                        {{-- remember old check password o browser --}}
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label" for="remember">
                                    <input type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }} class="form-input-styled" data-fouc>
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                        {{-- login btn --}}
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Login') }}
                                <i class="icon-circle-right2 ml-2"></i></button>
                        </div>
                        {{-- forget password link --}}
                        <div class="text-center">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>

                    </div>
                </div>
            </form>
            <!-- /login form -->

        </div>
    </div>
@endsection
