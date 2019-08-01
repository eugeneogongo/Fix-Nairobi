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
        ul {
            list-style: none;
        }
        #dos ul li:before {
            content: '✓ ';
        }
        #donts ul li:before{
            content: 'x ';
        }
    </style>
@endsection
@section('content')
    <div class="myrow mb-4">
        <div class="column-sm card">
            <div class="card-body">
                <h3>Report your Problem</h3>
                <form id="newissue" action="{{route('reportproblem')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-label-group">
                        <label for="location">Click the map or drag the pin to adjust the location</label>
                        <input type="text" hidden class="form-control" name="location" id="location" required/>
                    </div>
                    <div class="form-label-group">
                        <label for="issuetype">Category</label>
                        <select class="form-control" id="issuetype" name="issueid">
                            @foreach($type_issues as $item)
                                <option value="{{$item->id}}">{{$item->desc}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-label-group">
                        <label for="desc">Summarise the Problem <br><small class="text-info">eg Pothhole along Moi Avenue, Near Koja</small></label>
                        <input type="text" class="form-control" name="desc" required placeholder="Problem Title"/>
                    </div>
                    <p>Photos
                    </p>
                    <div class="myflex" style="overflow: auto;">
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
                    <div class="form-group shadow-textarea">
                        <label for="exampleFormControlTextarea6">Explain what’s wrong</label>
                        <textarea class="form-control z-depth-1" id="exampleFormControlTextarea6" name="moredetails" rows="3" placeholder="e.g. This pothole has been here for two months and…"></textarea>

                        <small>
                            <div class="d-flex flex-row form-text text-muted" style="margin-right: -30px">
                                <div class="p-2" id="dos">
                                    <ul  class="list-group text-success">
                                        <li>Be polite</li>
                                        <li>Use exact locations</li>
                                        <li>Include duration of the Issue</li>
                                    </ul>
                                </div>
                                <div class="p-2" id="donts">
                                    <ul class="list-group text-danger">
                                        <li>Don’t accuse other people</li>
                                        <li>Don’t include private details</li>
                                    </ul>
                                </div>
                            </div>
                        </small>
                    </div>
                    <div class="form-label-group">
                        <label for="landmark">Nearest LandMark</label>
                        <input type="text" id="landmark" class="form-control" placeholder="e.g Koja Roundabout or Kencom" name="landmark" required/>
                    </div>

                    <div class="form-label-group" style="margin-top: 10px">
                        @guest()
                            <input type="submit" class="btn btn-outline-success form-control"
                                   value="Report as Anonymous">
                        @elseauth()
                            <input type="submit" class="btn btn-outline-success form-control" value="Report">
                        @endguest()

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
                if (document.getElementById('location').value === "") {
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
                        if (data.status === 'success') {
                            swal("Good job!", "Your problem was submitted", "success");
                            window.location.replace("/report/update/"+data.problemid);
                        } else {
                            swal("Error", "There was a problem submiting your problem", "error");
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
                google.maps.event.addListenerOnce(map, 'idle', function(){
                    //this part runs when the mapobject shown for the first time
                    getLocation(map);
                });

        }

        function placeMarkerAndPanTo(latLng, map) {

            marker = new google.maps.Marker({
                position: latLng,
                map: map,
                title:"You are here"
            });
            
            document.getElementById('location').value = latLng;
            initilized = true;
        }

        function setImage(input, where) {
            let url = input.value;
            let ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0] && (ext === "gif" || ext === "png" || ext === "jpeg" || ext === "jpg")) {
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
            src="{{env('Map')}}">
    </script>
    <script>
        function getLocation(map) {
            if (navigator.geolocation) {
                //pan to location
                navigator.geolocation.getCurrentPosition(function (position) {
                    //pan to location
                   placeMarkerAndPanTo(new google.maps.LatLng(position.coords.latitude, position.coords.longitude,map));
                    map.panTo(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
                        map: map,
                        title:"You are here"
                    });

                    document.getElementById('location').value = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                });
            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        }

    </script>


@endsection

