@extends('layouts.app')
@section('css')
    <link href="{{\Illuminate\Support\Facades\URL::asset("css/mystyle.css")}}" rel="stylesheet"/>
    <link href="{{ asset ('css/dashboard.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('content')
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
                    <li>Click on the Post Problem Button</li>
                    <li>Locate the problem on a map of the area</li>
                    <li>Enter details of the problem</li>
                    <li>Submit the Problem</li>
                </ol>
            </div>
            <div>
                <h1>Recent Issues Reported</h1>
                <div class="container">
                    <div class="row">
                        @php
                            use Illuminate\Support\Facades\DB;$problems  =DB::table('problems')
                            ->select('problems.id as id','moredetails as detail','title','Location',"type_issues.desc",'path')
                            ->join('issuestatus','problems.id','=','issuestatus.issueid')
                            ->join("type_issues","type_issues.id","=","problems.issueid")
                            ->join("photos",'problems.id','=','photos.issueid')
                            ->where('status','=','not fixed')->limit(2)-> get();

                            foreach ($problems as $prob){
                            echo('<div class="card issuecard">');
                            echo('
                            <img class="card-img-top" src='.asset('images/'.$prob->path).' />
                           <div class="card-body">
                            <h5 class="card-title">'.$prob->title.'</h5> Was Reported at '.$prob->detail.'<br>
                            <a href=/viewissue/'.$prob->id.' class="btn btn-primary">View Issue</a>
                      </div></div>');
                            }
                        @endphp
                    </div>
                    <div>
                    </div>
                </div>
    </section>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
@endsection