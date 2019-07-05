<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@if(@isset($title))
    {{$title}}
    @else
    {{_('FixNairobi')}}
    @endif</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">



    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md  shadow-sm bg-nav">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                 FixNairobi
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @if (!Auth::guest())
                        @if(auth()->user()->isAdmin == 1)
                                <li class="nav-item" style="margin-right: 20px;">
                                    <a class="nav-link btn btn-primary" href="{{route('admin')}}">Dashboard</a>
                            </li>
                        @endif
                        @endif
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-success"
                               href="{{ route('reportproblem') }}">{{ __('Report a problem') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('about')}}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('complain')}}">Fill a Complain</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link btnRegister"
                                       href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
                <!---Mobile Resposive menu-->
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"><i class="fas fa-bars" onclick="openNav()"></i></span>
                </button>
                <div id="myNav" class="overlay">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <div class="overlay-content" id="myNav">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            @if (!Auth::guest())
                                @if(auth()->user()->isAdmin == 1)
                                    <li class="nav-item">
                                        <a class="btn btn-primary" href="{{route('admin')}}">Dashboard</a>
                                    </li>
                                @endif
                            @endif
                            <li class="nav-item">
                                <a class="nav-link btn btn-sm btn-outline-success"
                                   href="{{ route('register') }}">{{ __('Post a Problem') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Contact</a>
                            </li>
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link btnRegister"
                                           href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li>
                                    <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>

                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!--end mobile responsive -->
            @yield('content')

        <section>
            @component('layouts.footer')
            @endcomponent
        </section>

    </div>
    <script src="{{\Illuminate\Support\Facades\URL::asset('js/jquery.js')}}"></script>
    <script src="{{\Illuminate\Support\Facades\URL::asset('js/app.js')}}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function openNav() {
            document.getElementById("myNav").style.width = "100%";
        }

        function closeNav() {
            document.getElementById("myNav").style.width = "0%";
        }
    </script>
@yield('scripts')
</body>

</html>
