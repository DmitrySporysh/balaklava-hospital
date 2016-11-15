<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <title>@yield('title')</title>

    <link rel="shortcut icon" href="/img/mini-logo.png" type="image/png">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <!--Scripts for React -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.0/react.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.0/react-dom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.6.15/browser.js"></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <link href='https://fonts.googleapis.com/css?family=Fira+Sans&subset=latin,cyrillic' rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href={{asset('css/main_layout.css')}}>
    <link rel="stylesheet" href={{asset('css/modal.css')}}>
    @yield('css')
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}


</head>
<body id="app-layout">
<div class="wrap">
<!-- Header -->
    <nav class="navbar navbar-default navbar-static-top" id="header">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <div id="collapsed-menu"></div>

                <!-- <button type="button" class="navbar-toggle collapsed custom-navbar-toggle" data-toggle="collapse" data-target="#app-navbar-collapse">
                     <span class="sr-only">Toggle Navigation</span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                 </button> -->

                 <!-- Branding Image -->
                <a class="navbar-brand" href={{url('/')}}>
                    <img id="logo" src={{asset('img/logo.png') }} >
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li><a id="nav-link" href="{{ url('/instruction') }}">Инструкция</a> </li>
                    <li><a id="nav-link" href="{{ url('/rules') }}">Правила</a> </li>
                    @if (Auth::guest())
                        <li><a id="entry-button" href="{{ url('/entry') }}">Вход</a></li>
                    @else
                        <li><a id="nav-link" href="{{ url('/profile') }}">Профиль</a></li>
                        <li><a id="logout-link" href="{{ url('/logout') }}">Выход</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="menu">
        @yield('menu')
    </div>

    <div class="content">
        @yield('content')
    </div>

       <!-- JavaScripts -->
    <script type="text/babel" src={{asset('js/collapsed-menu.jsx')}}></script>
    <script type="text/javascript" src={{asset('js/csrf-token.js')}}></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

<!-- Footer -->
    <div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container">
            <p class="text-muted text-right">copyright 	&#169;</p>
        </div>
    </div>
</div>
</body>
</html>
