<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fix Nairobi</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{\Illuminate\Support\Facades\URL::asset("css/app.css")}}" rel="stylesheet"/>
    <link href="{{\Illuminate\Support\Facades\URL::asset("css/mystyle.css")}}" rel="stylesheet"/>


    <link href="{{\Illuminate\Support\Facades\URL::asset("css/register.css")}}" rel="stylesheet"/>
</head>
<body>
@include("layout.header")
<div class="container">
    <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
            <div class="card card-signin flex-row my-5">
                <div class="card-img-left d-none d-md-flex">
                    <!-- Background image for card set in CSS! -->
                </div>
                <div class="card-body">
                    <h5 class="card-title">Register</h5>
                    <form class="form-signin">
                        <div class="form-label-group">
                            <input type="text" id="inputUserame" class="form-control" placeholder="Username" required
                                   autofocus>
                            <label for="inputUserame">Username</label>
                        </div>

                        <div class="form-label-group">
                            <input type="email" id="inputEmail" class="form-control" placeholder="Email address"
                                   required>
                            <label for="inputEmail">Email address</label>
                        </div>

                        <hr>

                        <div class="form-label-group">
                            <input type="password" id="inputPassword" class="form-control" placeholder="Password"
                                   required>
                            <label for="inputPassword">Password</label>
                        </div>
                        <div class="form-label-group">
                            <input type="password" id="inputConfirmPassword" class="form-control" placeholder="Password"
                                   required>
                            <label for="inputConfirmPassword">Confirm password</label>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Register</button>
                        <a class="d-block text-center mt-2 small" href="#">Sign In</a>
                        <hr class="my-4">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>