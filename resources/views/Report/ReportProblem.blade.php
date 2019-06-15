@extends('layouts.app')
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
            flex: 1 0 20%; /* explanation below */
            margin: 5px;
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
            <div class="card-body">
                <form id="newissue" action="{{route('reportproblem')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-label-group">
                        <label for="location">Pick a location on the Map</label>
                        <input type="text" readonly class="form-control" name="location" id="location" required/>
                    </div>
                    <div class="form-label-group">
                        <label for="desc">Description of the Problem</label>
                        <input type="text" class="form-control" name="desc" required placeholder="Problem Description"/>
                    </div>
                    <p>Photos
                    <p/>
                    <div class="myflex">
                        <div class="child">

                            <input type="file" id="image1" name="image1" style="display: none;" accept="image/*"
                                   class="form-control-file" name="imagepic" onchange="setImage(this,'#img1')"/>
                            <img src="{{asset('images/placeholder.png')}}" id="img1" class="card-img-top bg"/>
                            <label for="image1" class="btn btn-primary btn-block pushup">Choose an Image</label>

                        </div>
                        <div class="child">
                            <input type="file" id="image2" name="image2" accept="image/*" class="form-control-file"
                                   name="imagepic" style="display: none;" onchange="setImage(this,'#img2')"/>
                            <img src="{{asset('images/placeholder.png')}}" id="img2" class="card-img-top bg"/>
                            <label for="image2" class="btn btn-primary btn-block pushup">Choose an Image</label>

                        </div>
                    </div>
                    <div class="form-label-group">
                        <label for="issuetype">Type of the issue</label>
                        <select class="form-control" name="issueid">
                            @foreach($type_issues as $item)
                                <option value="{{$item->id}}">{{$item->desc}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-label-group">
                        <label for="location">Issue Location</label>
                        <input type="text" class="form-control" placeholder="Nearest Location" name="moredetails"/>
                    </div>
                    <div class="form-label-group">
                        <label for="landmark">Nearest LandMark</label>
                        <input type="text" id="landmark" class="form-control" placeholder="LandMark" name="landmark" required/>

                    </div>

                    <div class="form-label-group" style="margin-top: 10px">
                        <input type="submit" class="btn btn-outline-success form-control" value="Report">
                    </div>

                </form>

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
            //hide loader
            $('#newissue').submit(function (e) {
                e.preventDefault();
                let formdata = new FormData(this);
                if (document.getElementById('location').value == "") {
                    swal("Pick Location", "Pick a location on the map", "error");
                    document.getElementById('map').scrollIntoView();
                    return;
                }
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
        let marker;
        let images = [];
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
        }

        function placeMarkerAndPanTo(latLng, map) {
            marker = new google.maps.Marker({
                position: latLng,
                map: map
            });
            document.getElementById('location').value = latLng;
            initilized = true;
        }

        function setImage(input, where) {
            let url = input.value;
            let ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                let reader = new FileReader();

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

