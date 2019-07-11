@extends('layouts.app')
@section('css')
    <link href="{{\Illuminate\Support\Facades\URL::asset("css/mystyle.css")}}" rel="stylesheet"/>
    <link href="{{ asset ('css/dashboard.css')}}" rel="stylesheet" type="text/css">
    <style>
        .counter {
            text-align: center;
        }

        .employees, .customer, .design, .order {

        }

        .counter-count {
            font-size: 18px;
            background-color: green;
            border-radius: 50%;
            position: relative;
            color: #ffffff;
            text-align: center;
            line-height: 52px;
            width: 52px;
            height: 52px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -ms-border-radius: 50%;
            -o-border-radius: 50%;
            display: inline-block;
        }

        .employee-p, .customer-p {
            font-size: 20px;
            color: #000000;
            line-height: 34px;
        }
        .ctabg{
            background-color: white;
        }

        .cta-title{
            margin: 0 auto 15px;
            padding: 0;
        }

        .cta-desc{
            padding: 0;
        }

        .cta-desc p:last-child{
            margin-bottom: 0;
        }


        @media (max-width: 991px){
            .bs-calltoaction > .row{
                display:block;
                width: auto;
            }

            .bs-calltoaction > .row > [class^="col-"],
            .bs-calltoaction > .row > [class*=" col-"]{
                float:none;
                display:block;
                vertical-align:middle;
                position: relative;
            }

            .cta-contents{
                text-align: center;
            }
        }

        .bs-calltoaction.bs-calltoaction-success{
            color: #fff;
            background-color: #5cb85c;
            border-color: #4cae4c;
        }

    </style>
@endsection
@section('content')
    <section id="report" class="text-lg-center">
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
                <hr style="color: green">
                <div class="counter">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="employees">
                                <p class="counter-count">879</p>
                                <p class="employee-p">Issue Reported</p>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="customer">
                                <p class="counter-count">954</p>
                                <p class="customer-p">Issue Fixed</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="divline">
                <h1>Recent Reported Issues</h1>
                <div class="container">

                        @php
                            use Illuminate\Support\Facades\Storage;
                            $problems  =DB::table('problems')
                                ->select('problems.id as id','moredetails as detail','Title','location',"Type_issues.desc",'path','problems.created_at as publisheddat')
                                ->join('IssueStatus','problems.id','=','IssueStatus.issueid')
                                ->join("Type_issues","Type_issues.id","=","problems.issueid")
                                ->join("photos",'problems.id','=','photos.issueid')
                                ->where('status','=','Not Fixed')->orderBy('problems.created_at', 'desc')
                                ->limit(4)-> get();

                                foreach ($problems as $prob){
                                echo('<a href=/viewissue/'.$prob->id.'>');
                                echo('
                                <div>
                                 <img class="rounded" style="float:right;width:90px;height:60px;margin-left: 1em;" src="'.Storage::url($prob->path).'" alt='.$prob->Title.' Image'.' />
                                 '.$prob->Title.' Was Reported at '.$prob->detail.'</br>
                                 <small>'.$prob->publisheddat.'</small>
                                 </div>
                             </a>
                             <hr>');
                                }
                        @endphp
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container mb-3 ctabg border">
        <div class="row">

        <div class="col-md-5 border-right mt-5 mb-2">
                <img class="card-img rounded" height="350px" width="400px" src="https://img.etimg.com/thumb/height-480,width-640,msid-67394105,imgsize-68202/complaint-getty.jpg"/>
        </div>
        <div class="col-md-6 mb-3 mt-5 justify-content-center">
            <h1 class="cta-title mt-3">Do you have any ...</h1>
            <ul>
                <li class="list-group-item">Feedback</li>
                <li class="list-group-item">Complain</li>
                <li class="list-group-item">Suggestion</li>
            </ul>
            <a href="{{route('complain')}}" class="btn btn-success btn-block ml-auto ml-auto">Submit It!</a>
        </div>
        </div>
    </div>
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
    <script>
        $('.counter-count').each(function () {
            $(this).prop('Counter', 0).animate({
                Counter: $(this).text()
            }, {
                duration: 5000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });
    </script>
@endsection