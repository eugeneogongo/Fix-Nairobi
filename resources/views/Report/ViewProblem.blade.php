@extends(isset(auth()->user()->isAdmin)?'layouts.adminmaster':'layouts.app')
@section('css')
    <link href="{{\Illuminate\Support\Facades\URL::asset("css/mystyle.css")}}" rel="stylesheet"/>
    <link href="{{\Illuminate\Support\Facades\URL::asset("css/reportproblem.css")}}" rel="stylesheet"/>
    <style>
        .myflex {
            display: flex;
            flex-wrap: wrap;
            border: 1px #1b1e21;
            padding: 10px;
        }

        .child {
            flex: 1 0 10%; /* explanation below */
            margin: 1px;
            height: 200px
        }

        .child > img {
            height: 100px;
            width: 100px;
        }

        .bg {
            background: grey;
        }

    </style>
@endsection
@section('content')
    <div class="myrow mb-5">
        <div class="column-sm card">

            <div class="form-label-group">
                <label><b>Title: </b>{{$problem[0]->Title}}</label>

            </div>
            <div class="form-label-group">
                <label><strong>Summary of the Problem: </strong>{{$problem[0]->moredetails}}</label>
            </div>
            <div class="form-label-group">
                <label><strong>LandMark: </strong>{{$problem[0]->landmark}}</label>
            </div>
            <div class="form-label-group">
                <label><strong>IssuesStatus: </strong>{{$problem[0]->status}}</label>
            </div>
            <hr>

            <p>Photos </p>
            <div class="myflex">
                @isset($problem[0]->path)
                <div class="child">
                    <img src="{{Storage::url($problem[0]->path)}}" id="img1" class="card-img-top bg"/>
                </div>
                @endisset
                @isset($problem[1]->path)
                <div class="child">
                    <img src="{{Storage::url($problem[1]->path)}}" id="img2" class="card-img-top bg"/>
                </div>
                @endisset
            </div>
            @auth()
                @if(auth()->user()->isAdmin==1)
                    <div class="text-center mb-2 mb-sm-1">
                        <form method="post" id="fix" action="{{route('fix')}}">
                            @csrf
                            <input type="text" name="id" value="{{$problem[0]->issueid}}" hidden>
                            <button class="btn btn-outline-primary">Mark Issue as Fixed</button>
                        </form>

                    </div>
                @endif
            @endauth
            <div class="card-footer">
                reported by <strong> {{$problem[0]->name}} </strong>at
                <small> {{$problem[0]->created_at}}</small>
            </div>
        </div>
        <div id="map" class="column-lg card"></div>
    </div>
@endsection
@section('scripts')

    <script src="{{\Illuminate\Support\Facades\URL::asset('js/jquery.js')}}"></script>
    <script src="{{\Illuminate\Support\Facades\URL::asset('js/app.js')}}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script rel="script">
        $(document).ready(function () {

            $('#fix').submit(function (e) {
                e.preventDefault();
                let formdata = new FormData(this);
                let form = $(this);
                let url = form.attr('action');

                $.ajax({
                    type: "POST",
                    url: url,
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formdata, // serializes the form's elements.
                    success: function (data) {
                        console.log(data.status);
                        if (data.status === 'success') {
                            swal("Good job!", "The Issues has been marked as fixed", "success");
                            window.location = ('/admin')
                        } else {
                            swal("Error", "There was a problem", "error");
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }

                });


            });
        });
    </script>
    <script>
        let marker;
        let initilized = false;

        function initMap() {
            let map = new google.maps.Map(document.getElementById('map'), {
                zoom: 16,
                center: {lat: -1.28333, lng: 36.8219}
            });

            map.addListener('click', function (e) {
                if (initilized) {
                    marker.setMap(null);
                }
                placeMarkerAndPanTo(e.latLng, map);


            });
            google.maps.event.addListenerOnce(map, 'idle', function () {
                var loca = "{{$problem[0]->location}}";
                loca = loca.replace('(', "");
                loca = loca.replace(')', "");
                var coord = loca.split(',');
                //pan to location
                map.panTo(new google.maps.LatLng(coord[0], coord[1]));
                //set to marker
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(coord[0], coord[1]),
                    map: map
                });
            });
        }
    </script>
    <script async defer
            src="{{env('Map')}}">
    </script>



@endsection


