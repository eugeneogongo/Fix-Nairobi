@extends('layouts.formmaster')
@section("header")
    Register
    @endsection
@section('form')
    <form method="POST" action="{{ route('register') }} " >
        @csrf

        <div class="form-label-group">

            <input id="name" type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
            <label for="name">{{ __('Name') }}</label>
        </div>
        <div class="form-label-group">

            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address">

            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
            <label for="email">{{ __('E-Mail Address') }}</label>

        </div>

        <div class="form-label-group">

            <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
            <label for="password">{{ __('Password') }}</label>

        </div>

        <div class="form-label-group">
            <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            <label for="password-confirm">{{ __('Confirm Password') }}</label>

        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="d-block btn btn-primary align-items-center">
                    {{ __('Register') }}
                </button>

            </div>
        </div>

    </form>
    <hr>
    <div class="text-center">
        <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
    </div>
    @endsection