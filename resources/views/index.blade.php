<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fix Nairobi</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{\Illuminate\Support\Facades\URL::asset("css/app.css")}}" rel="stylesheet"/>
    <link href="{{\Illuminate\Support\Facades\URL::asset("css/mystyle.css")}}" rel="stylesheet"/>



</head>

<body>
@include('layout.header')

<section id="report" class="text-center">

    <h1 id="reportheader"></h1>
    <h2>(like graffiti, fly tipping, broken paving slabs, or street lighting)</h2>
    <a class="btn btn-primary btn-lg" href="{{route('reportproblem')}}">Post a Problem</a>
</section>
<div class="container">

    <section class="content-Home card">
        <div class="tablewrapper">
            <div class="container">
                <h1>How to Report an Issue</h1>
                <ol class="problem-list">
                    <li>Enter a nearby UK postcode, or street name and area</li>
                    <li>Locate the problem on a map of the area</li>
                    <li>Enter details of the problem</li>
                    <li>We send it to the council on your behalf</li>
                </ol>
            </div>
            <div>
                <h1>Recent Issues Reported</h1>
            </div>
        </div>
    </section>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeit/6.0.3/typeit.min.js"></script>
<script>
    new TypeIt('#reportheader', {
        speed: 50,
        startDelay: 900
    })
        .type('Report, view, or discuss local problems  ')
        .pause(300)
        .pause(250)
        .pause(750)
        .options({speed: 100, deleteSpeed: 75})
        .pause(750)
        .type('in <br><em>Nairobi County.</em>')
        .go().stop();
</script>