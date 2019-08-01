@extends('layouts.app')
@section('css')
    <link href="{{\Illuminate\Support\Facades\URL::asset("css/mystyle.css")}}" rel="stylesheet"/>
    <link href="{{\Illuminate\Support\Facades\URL::asset("css/reportproblem.css")}}" rel="stylesheet"/>
    <style>
        @media (min-width: 1025px) {

            .confirmation {

                width: 40em;
                margin: 0 auto 1em;
                text-align: left;
                padding: 3em 0 3em 132px;
                background-position: left 2em;
                background-repeat: no-repeat;
                background-size: 100px 100px;
                background-image: url("{{asset('images/checked.png')}}");

            }

            .confirmation h1, h2 {

                margin: 0;
                line-height: 1.2em;
            }

            .confirmation {
                background-position: left 2em;
                background-repeat: no-repeat;
                background-size: 100px 100px;
                background-image: url("{{asset('images/checked.png')}}");
            }
        }

    </style>
@endsection
@section('content')
    <div class="container mt-5 mb-5">
        <div class="card">
            <div class="confirmation">
                <h1 class="display-3">{{ucfirst($problem->Title)}}</h1>
                <h2 class="lead">Thank you for making Nairobi Better! We have recieved your update or Problem</h2>
                </p>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4 border-right">
                    <h1 class="ml-3 ">Great work. Now spread the word!</h1>
                    <p class="ml-3 lead">Share how you have contributed to a better Nairobi</p>
                </div>
                <div class="col-sm-4 border-right">
                    <h1 class="ml-3 ">Share More Problems!</h1>
                    <p class="ml-3 lead">The more you contribute the more we make lively hood better</p>
                </div>
                <div class="col-sm-4">
                    <h1 class="ml-3 ">Lets Make Nairobi Great!</h1>
                    <p class="ml-3 lead">Better City, Better Life</p>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
