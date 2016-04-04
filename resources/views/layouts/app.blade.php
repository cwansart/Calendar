<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kalender</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="{!! asset('css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/bootstrap-datetimepicker.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/font-awesome.min.css') !!}" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <script src="{!! asset('js/jquery.min.js') !!}"></script>
    <script src="{!! asset('js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('js/moment-with-locales.min.js') !!}"></script>
    <script src="{!! asset('js/bootstrap-datetimepicker.js') !!}"></script>

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }

        .calendar td {
            width: 14.28%;
            height: 80px;
        }

        .calendar td:hover {
            background-color: #337ab7;
            cursor: pointer;
            color: white;
        }

        .not-in-month, .not-in-month:hover {
            background-color: #f9f2f4 !important;
            cursor: default !important;
        }
    </style>
</head>
<body id="app-layout">

    <nav class="navbar navbar-default navbar-static-top">

        <div class="container">


            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{!! asset('images/evos.png') !!}">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/') }}">Startseite</a></li>
                    <li><a href="{{ url('/calendar') }}">Kalender</a></li>
                    <li><a href="https://github.com/SStalker/EVOS">Quellcode</a></li>
                    <li><a href="https://toggl.com/app/timer">Toggl</a></li>
                    <li><a href="https://netcase.hs-osnabrueck.de/index.php/apps/files/?dir=%2FEVOS">NetCase</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/change_password') }}"><i class="fa fa-key fa-fw"></i>Passwort ändern</li>
                                <li><a href="{{ url('/receive_mail') }}"><i class="fa fa-bell-o"></i>Benachrichtigungen ändern</li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>

            </div>
        </div>

    </nav>

    @if ($errors->any())
        <div class="alert alert-danger">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            Es gab ein paar Probleme:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('message'))
        <div class="alert alert-success" role="alert">
            <span class="glyphicon glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
            {!! session('message') !!}
        </div>
    @endif

    <div class="container-fluid">
    @yield('content')
    </div>

    <!-- JavaScripts -->

    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
