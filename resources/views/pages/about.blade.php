@extends('layouts.app')
@section('css')
    <link href="{{\Illuminate\Support\Facades\URL::asset("css/mystyle.css")}}" rel="stylesheet"/>
    <link href="{{ asset ('css/dashboard.css')}}" rel="stylesheet" type="text/css">
    <link href="{{\Illuminate\Support\Facades\URL::asset("css/mystyle.css")}}" rel="stylesheet"/>
    <link href="{{\Illuminate\Support\Facades\URL::asset("css/register.css")}}" rel="stylesheet"/>
@endsection
@section('content')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-4 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <h1 class="card-title bg-nav"> Efficient and effective service delivery system</h1>
                                    <ul class="list-group">
                                        <li class="list-group-item">People- centred health care system that puts clients
                                            at the heart of the
                                            service we provide
                                        </li>
                                        <li class="list-group-item">Providing the best care possible within available
                                            resources
                                        </li>
                                        <li class="list-group-item"> Working with communities to empower them to take
                                            charge of their
                                            own health
                                        </li>
                                        <li class="list-group-item">Continuous learning and improvement of our systems
                                            to better the
                                            services we provide
                                        </li>
                                        <li class="list-group-item">Participatory management approaches where teamwork
                                            is encouraged–
                                            working collectively in the health facility and with clients, families,
                                            communities and other players for continued improvement of our
                                            health services.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
