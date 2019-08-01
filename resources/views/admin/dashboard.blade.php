@extends('layouts.adminmaster')
@section('content')
            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Hello {{auth()->user()->name}},Stats at a glance</h1>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <!-- Earnings Problems Reported -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Problems Reported</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                           {{ _($count = \FixNairobi\Problem::all()->count()) + 10}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Problems Fixed</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                         {{
                                          _($count = \FixNairobi\Problem::all()->count()) + 10
                                         }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">New Problems</div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ _($count = \FixNairobi\Problem::all()->count()) + 10}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card Example -->
                    <div>
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Problems Attended to</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ _($count = \FixNairobi\Problem::all()->count()) + 10}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Row -->

                <div class="row">

                    <!-- Area Chart -->
                    <div>
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">New Issues</h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                </div>
                            </div>
                            <!-- Card Body -->

                                    <div class="container">


                                        <div class="row justify-content-center">
                                @php
                                    use Illuminate\Support\Facades\DB;$problems  =DB::table('problems')
                                    ->select('problems.id as id','moredetails as detail','Title','location',"Type_issues.desc",'path')
                                    ->join('IssueStatus','problems.id','=','IssueStatus.issueid')
                                    ->join("Type_issues","Type_issues.id","=","problems.issueid")
                                    ->join("photos",'problems.id','=','photos.issueid')
                                    ->where('status','=','not fixed')->limit(12)-> get();

                                    foreach ($problems as $prob){
                                    echo('<div class="card issuecard">');
                                    echo('
                                    <img class="card-img-top" src='.Storage::url($prob->path).' />
                                   <div class="card-body">
                                    <h5 class="card-title">'.$prob->Title.'</h5> Was Reported at '.$prob->detail.'<br>
                                    <a href=viewissue/'.$prob->id.' class="btn btn-primary">View Issue</a>
                              </div></div>');
                                    }
                                @endphp
                        </div>
                    </div>
                        </div>
                    </div>


                <!-- Content Row -->
                <div class="row">

                    <!-- Content Column -->
                    <div class="col-lg-6 mb-4">

                        <!-- Project Card Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Statistics of Problems Reported</h6>
                            </div>
                            <div class="card-body">
                                @isset($stats)
                                    @foreach($stats as $stat)
                                <h4 class="small font-weight-bold">{{$stat->desc}}<span class="float-right">Total: {{$stat->count}}</span></h4>
                                <div class="progress mb-4">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{$stat->count}}%" aria-valuenow="{{$stat->count}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                    @endforeach
                               @endisset
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6 mb-4">
                        <!-- Approach -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Latest FeedBack</h6>
                            </div>
                            <div class="card-body">
                                @if($feedback != null)
                                <p>from :{{$feedback->email}}</p>
                                <p class="mb-0">{{$feedback->message}}><p>
                                    @endif
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>{{env('APP_NAME')}} &copy; Your Website 2019</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
            <!-- Page level custom scripts -->

<!-- End of Page Wrapper -->
@endsection

@section('scripts')
    <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>
    <!-- Page level plugins -->
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
@endsection

