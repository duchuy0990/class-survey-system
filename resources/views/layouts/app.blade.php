<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Class Survey System</title>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    

    <!-- Fonts -->
    @yield('css')
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    {{--  <link rel="stylesheet" type="text/css" href="{{ asset('css/sweet-alert.css') }}">  --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/background.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/st_tc.css') }}">
</head>
<body>
    <div id="app">
    <nav class="navbar navbar-expand-md navbar-dark bg-primary mb-4 fixed-top">
        @yield('guard')
        @guest
        @else
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="mr-auto mt-2 mt-md-0"></div>
            <div class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle navbar-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <span class="user-name" id="user-name">@yield('username')</span>
                            <img class="usericon" src="{{asset('images/usericon.png')}}">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item logout-user" type="button" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            Thoát
                            <img src="{{asset('images/exit.png')}}" style="width:20px;height:20px">
                        </button>
                        <form id="logout-form" action="@yield('link_logout')" method="POST" style="display: none;">
                                @csrf
                        </form>
                    </div>
            </div>
        </div>
        @endguest
	</nav>
        <div class="container">
            @yield('content')
        </div>
    </div>

    <div class="modal fade" id="loaderModal" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="loader"><div></div><div></div><div></div><div></div></div>
        </div>
    </div>
    @yield('script')
</body>
</html>
