@extends(isset(auth()->user()->isAdmin)?'layouts.adminmaster':'layouts.app')
@section('css')
    <link href="{{\Illuminate\Support\Facades\URL::asset("css/mystyle.css")}}" rel="stylesheet"/>
    <link href="{{\Illuminate\Support\Facades\URL::asset("css/reportproblem.css")}}" rel="stylesheet"/>
    <style>
        body{
            font-family: "Museo300-display",MuseoSans,Helmet,Freesans,sans-serif;
        }

        textarea{
            /* box-sizing: padding-box; */
            overflow:hidden;
            /* demo only: */
            padding:10px;
            width:250px;
            font-size:14px;
            margin:50px auto;
            display:block;
            border-radius:10px;
            border:6px solid #556677;
        }
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
        h1 {
            font-family: "Museo300-display",MuseoSans,Helmet,Freesans,sans-serif;
            font-size: 2em;
            line-height: 1em;
            font-weight: normal;
            margin-top: 0.5em;
            margin-bottom: 0.5em;
        }
        .meta-info{
            font-size:1em;
            font-weight: normal;
            margin: 0 0 1em;
        }
        .description{
            margin: 1em 0 0 0;
            padding: 1em;
            background: #fff;
            color: #222;
        }
        div >p{
            font-size: 1em;
            font-weight: normal;
            margin: 0 0 1em;
            display: block;
        }
        h2{
            font-family: "Museo300-display",MuseoSans,Helmet,Freesans,sans-serif;
            font-size: 1.5em;
            line-height: 1.3333em;
            font-weight: normal;
            margin-bottom: 0.666666666em;
        }
        @media (min-width: 1025px) {

            .anyClass {
                height:600px;
                overflow-y: scroll;
            }

        }
        @media (max-width: 600px) {
            article, aside, figcaption, figure, footer, header, hgroup, main, nav, section {
                display: block;
                padding-top: 120px;
            }

        }

    </style>
@endsection
@section('content')
    <div class="container mb-3 mt-3" style="display: block">
    <div class="row mb-2" style="height: 600px;">
        <div id="map" class="col-sm-8 card order-sm-1"></div>
        <div class="col-sm-4 card order-sm-2">
            <div class="container anyClass">
                <h1>{{ ucfirst( $problem[0]->Title)}}</h1>
            <div class="meta-info">
                Reported by <strong>
                    @if($problem[0]->name ===null)
                        {{('Anonymous')}}
                    @else
                        {{$problem[0]->name}}
                    @endif
                </strong>at
                <small> {{($problem[0]->created_at)}}</small>
            </div>
            <div class="container">
                <div class="row">
                @isset($problem[0]->path)
                    <div class="col-6">
                        <img src="{{Storage::url($problem[0]->path)}}" id="img1" class="card-img-top"/>
                    </div>
                @endisset
                @isset($problem[1]->path)
                    <div class="col-6">
                        <img src="{{Storage::url($problem[1]->path)}}" id="img2" class="card-img-top"/>
                    </div>
                @endisset
                </div>
            </div>
            <div class="description">
                <p>{{$problem[0]->moredetails}}</p>
                <p>LandMark<strong> {{$problem[0]->landmark}}</strong></p>
                <p> <strong>Status: </strong>The Issue is {{$problem[0]->status}}</p>
            </div>
                @isset($updates)
                    @if(count($updates)>0)
                    <h4>Updates</h4>
                    @endif
                    <ul class="list-group list-group-flush">
                    @foreach($updates as $update)
                            <li class="list-group-item">{{$update->content}}</li>
                        @endforeach
                    </ul>
                    @endisset
            <h2>
                Provide Your update
            </h2>
                <form class="text-center mt-2" method="post" action="{{route('update')}}">
                    @csrf
                    <textarea name="update" rows="2" class="form-control" id="form_update" required="" spellcheck="false"></textarea>
                    <input name="problemid" value="{{$problem[0]->issueid}}" hidden>
                 <div class="form-group mt-2">
                     <input type="submit" class="btn btn-info"  value="Post Update"/>
                 </div>
                </form>

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
        </div>
        </div>
    </div>
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
                        console.log(data);
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
<script>
    var textarea = document.querySelector('textarea');

    textarea.addEventListener('keydown', autosize);

    function autosize(){
        var el = this;
        setTimeout(function(){
            el.style.cssText = 'height:auto; padding:0';
            // for box-sizing other than "content-box" use:
            // el.style.cssText = '-moz-box-sizing:content-box';
            el.style.cssText = 'height:' + el.scrollHeight + 'px';
        },0);
    }
</script>


@endsection


