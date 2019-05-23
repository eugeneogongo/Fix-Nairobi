@extends('layouts.formmaster')

@section('header')
    Login
@endsection
@section('form')
    <form method="POST" action="{{ route('login') }}" class="form-signin" >
        @csrf
        <div class="form-label-group">

            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Email" autofocus>
            <label for="email" >{{ __('E-Mail Address') }}</label>
            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>

        <div class="form-label-group">

            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
            <label for="password" >{{ __('Password') }}</label>
        </div>


        <div class="form-group">

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>

            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">
            {{ __('Login') }}
        </button>
    </form>
    <hr>
    <div class="text-center">
        <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
    </div>
    <div class="text-center">
        <a class="small"  href="{{'/register'}}">Create an Account!</a>
    </div>
    @endsection
