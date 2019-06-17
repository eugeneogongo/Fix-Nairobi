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

        .hide {
            visibility: hidden;
        }

        .visible {
            visibility: visible;
        }

        .bg {
            background: grey;
        }

        .pushup {
            margin-top: -10px;
            position: relative;
        }

    </style>
@endsection
@section('content')
    <div class="myrow">
        <div class="column-sm card">

            <div class="form-label-group">
                <label><b>Title: </b>{{$problem[0]->Title}}</label>

            </div>
            <div class="form-label-group">
                <label><strong>Details: </strong>{{$problem[0]->moredetails}}</label>
            </div>
            <div class="form-label-group">
                <label><strong>LandMark: </strong>{{$problem[0]->landmark}}</label>
            </div>
            <div class="form-label-group">
                <label><strong>IssuesStatus: </strong>{{$problem[0]->status}}</label>
            </div>
            <hr>
            <p>Photos
            <p/>
            <div class="myflex">
                <div class="child">
                    <img src="{{asset('images/')}}/{{$problem[0]->path}}" id="img1" class="card-img-top bg"/>
                </div>
                <div class="child">
                    <img src="{{asset('images/')}}/{{$problem[1]->path}}" id="img2" class="card-img-top bg"/>
                </div>
            </div>
            <div class="card-img-bottom">
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
            $('#newissue').submit(function (e) {
                e.preventDefault();
                var formdata = new FormData(this);
                if (document.getElementById('location').value == "") {
                    swal("Pick Location", "Pick a location on the map", "error");
                    document.getElementById('map').scrollIntoView();
                    return;
                }
                var form = $(this);
                var url = form.attr('action');

                $.ajax({
                    type: "POST",
                    url: url,
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formdata, // serializes the form's elements.
                    success: function (data) {
                        console.log(data.status);
                        if (data.status == 'success') {
                            swal("Good job!", "Your problem was submitted", "success");
                            document.getElementById("newissue").reset();
                        } else {
                            swal("Error", "There was a problem submiting your problem", "error");
                        }

                    },
                    error: function (data) {
                        console.log("error");
                        console.log(data);
                    }

                });


            });
        });
    </script>
    <script>
        var marker;
        var images = [];
        var initilized = false;

        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
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
                console.log(loca);
                //pan to locatio
                map.panTo(new google.maps.LatLng(coord[0], coord[1]));
                //set to marker
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(coord[0], coord[1]),
                    map: map
                });
            });
        }

        function setImage(input, where) {
            var url = input.value;
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(where).attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                $(where).attr('src', '/assets/no_preview.png');
            }
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWIHgQV9GMX2yUDSMkjkdFlRGeXY_tFNo&callback=initMap">
    </script>



@endsection


