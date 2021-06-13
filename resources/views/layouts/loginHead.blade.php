<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Eastern Delivery Express Limited</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class=".bg-secondary">
    <div id="app">
        <div class="container pt-5 mt-5">
            <div class="w-500  align-content-center pt-5">
                <div class="card col-md-12">
                    <div class="card-body">
                        <div class="card-title text-center font-weight-bold display-4 mb-5">
                        Eastern Delivery Express Limited
                        </div>
                        <div class="card-text ">
                         @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</body>
</html>
