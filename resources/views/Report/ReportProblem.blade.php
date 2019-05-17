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
            <div class="card-body">
                <form id="newissue">
                    <div class="form-label-group">
                        <label for="location">Pick a location on the Map</label>
                        <input type="text" disabled class="form-control" name="location" id="location"/>
                    </div>
                    <div class="form-label-group">
                        <label for="desc">Description of the Problem</label>
                        <input type="text" class="form-control" name="desc"/>
                    </div>
                    <p>Photos
                    <p/>
                    <div class="myflex">
                        <div class="child">

                            <input type="file" id="image1" name="image1" style="display: none;" accept="image/*"
                                   class="form-control-file" name="imagepic" onchange="setImage(this,'#img1')" required>
                            <img src="{{asset('images/placeholder.png')}}" id="img1" class="card-img-top bg"/>
                            <label for="image1" class="btn btn-primary btn-block pushup">Choose an Image</label>

                        </div>
                        <div class="child">
                            <input type="file" id="image2" name="image2" accept="image/*" class="form-control-file"
                                   name="imagepic" style="display: none;" onchange="setImage(this,'#img2')" required>
                            <img src="{{asset('images/placeholder.png')}}" id="img2" class="card-img-top bg"/>
                            <label for="image2" class="btn btn-primary btn-block pushup">Choose an Image</label>

                        </div>
                    </div>
                    <div class="form-label-group">
                        <label for="issuetype">Type of the issue</label>
                        <input type="text" class="form-control" name="issuetype"/>
                    </div>
                    <div class="form-label-group">
                        <label for="landmark">Nearest LandMark</label>
                        <input type="text" class="form-control" name="landmark"/>

                    </div>
                    <div class="form-label-group">
                        <label for="location">Issue Location</label>
                        <input type="text" class="form-control" name="location"/>
                    </div>
                    <div class="form-label-group" style="margin-top: 10px">
                        <input type="submit" class="btn btn-outline-success form-control" value="Report">
                    </div>

                </form>

            </div>
        </div>
        <div id="map" class="column-lg card"></div>
    </div>

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
@include('layout.footer')
