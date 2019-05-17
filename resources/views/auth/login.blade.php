@extends('layouts.app')
@section('css')
    <link href="{{\Illuminate\Support\Facades\URL::asset("css/mystyle.css")}}" rel="stylesheet"/>
    <link href="{{\Illuminate\Support\Facades\URL::asset("css/register.css")}}" rel="stylesheet"/>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto">
                <div class="card card-signin flex-row my-lg-5">
                    <div class="card-img-left d-none d-md-flex">
                        <!-- Background image for card set in CSS! -->
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Login</h5>
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


                        <div class="form-group row">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>

                            </div>
                        </div>
                        <span>
                                <button type="submit" class="btn btn-primary btn-group-sm">
                                    {{ __('Login') }}
                                </button>
                                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                <a class="d-block btn btn-outline-success align-items-center text-center mt-2 small" href="{{'register'}}">Register</a>

</span>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
