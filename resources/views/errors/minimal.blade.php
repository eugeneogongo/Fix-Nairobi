<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>

            html, body {
                background-color: #fff;
                color: black;
                font-family: 'Nunito', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .btn {
                background-color: #4CAF50; /* Green */
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
            }
            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .code {
                border-right: 2px solid;
                font-size: 26px;
                padding: 0 15px 0 15px;
                text-align: center;

            }

            .message {
                font-size: 18px;
                text-align: center;
            }
        </style>
    </head>
    <body>

        <div class="flex-center position-ref full-height">
            <img class="card-img"
                 src="https://epayments.nairobi.go.ke/public/img/logo/nairobi-city-county-logo.png"
                 alt="Nairobi county logo" width=200/>
            <div class="code">
                @yield('code')
            </div>
            <div class="message code" style="padding: 10px;">
                @yield('message')
            </div>
            <div class="code">
                <a href="/home" class="btn"> Go Home</a>
            </div>
        </div>
    </body>
</html>
