<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Accessing Arguments in UI Events</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link href="{{\Illuminate\Support\Facades\URL::asset("css/app.css")}}" rel="stylesheet"/>
    <link href="{{\Illuminate\Support\Facades\URL::asset("css/mystyle.css")}}" rel="stylesheet"/>
    <link href="{{\Illuminate\Support\Facades\URL::asset("css/reportproblem.css")}}" rel="stylesheet"/>

</head>
<body>
@include('layout.header')



<div class="myrow">

<div class="column-sm card">

</div>
<div id="map" class="column-lg card"></div>
</div>

<script>
    var marker;
    var initilized = false;
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 18,
            center: {lat:-1.28333, lng: 36.8219 }
        });

        map.addListener('click', function(e) {
            if(initilized){
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
        initilized = true;
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWIHgQV9GMX2yUDSMkjkdFlRGeXY_tFNo&callback=initMap">
</script>
</body>
</html>