<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>

    <!-- jQuery library -->


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}"></script>

{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
<!-- Styles -->
    <style>
        /*html, body {*/
        /*background-color: #fff;*/
        /*color: #636b6f;*/
        /*font-family: 'Raleway', sans-serif;*/
        /*font-weight: 100;*/
        /*height: 100vh;*/
        /*margin: 0;*/
        /*}*/

        /*!*!*.full-height {*!*!*/
        /*!*!*height: 100vh;*!*!*/
        /*!*!*}*!*!*/

        /*.flex-center {*/
        /*align-items: center;*/
        /*display: flex;*/
        /*justify-content: center;*/
        /*}*/

        /*.position-ref {*/
        /*position: relative;*/
        /*}*/

        /*!*.top-right {*!*/
        /*!*position: absolute;*!*/
        /*!*right: 10px;*!*/
        /*!*top: 18px;*!*/
        /*!*}*!*/

        /*!*.content {*!*/
        /*!*text-align: center;*!*/
        /*!*}*!*/

        .title {
            font-size: 30px;
        }

        /*!*.links > a {*!*/
        /*!*color: #636b6f;*!*/
        /*!*padding: 0 25px;*!*/
        /*!*font-size: 12px;*!*/
        /*!*font-weight: 600;*!*/
        /*!*letter-spacing: .1rem;*!*/
        /*!*text-decoration: none;*!*/
        /*!*text-transform: uppercase;*!*/
        /*!*}*!*/

        /*!*.m-b-md {*!*/
        /*!*margin-bottom: 30px;*!*/
        /*!*}*!*/

        /*!*.snip1423 {*!*/
        /*!*font-family: 'Oswald', Arial, sans-serif;*!*/
        /*!*position: relative;*!*/
        /*!*float: left;*!*/
        /*!*!*margin: 20px 1%;*!*!*/
        /*!*min-width: 230px;*!*/
        /*!*max-width: 315px;*!*/
        /*!*width: 100%;*!*/
        /*!*background: #ffffff;*!*/
        /*!*text-align: center;*!*/
        /*!*color: #000000;*!*/
        /*!*box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);*!*/
        /*!*font-size: 16px;*!*/
        /*!*padding: 15px;*!*/
        /*!*-webkit-box-sizing: border-box;*!*/
        /*!*box-sizing: border-box;*!*/
        /*!*-webkit-transition: all 0.2s ease-out;*!*/
        /*!*transition: all 0.2s ease-out;*!*/
        /*!*}*!*/

        /*.snip1423 * {*/
        /*-webkit-box-sizing: padding-box;*/
        /*box-sizing: padding-box;*/
        /*-webkit-transition: all 0.2s ease-out;*/
        /*transition: all 0.2s ease-out;*/
        /*}*/

        /*.snip1423 img {*/
        /*max-width: 100%;*/
        /*vertical-align: top;*/
        /*position: relative;*/
        /*}*/

        /*.snip1423 figcaption {*/
        /*padding: 20px 15px;*/
        /*}*/

        /*.snip1423 h3,*/
        /*.snip1423 p {*/
        /*margin: 0;*/
        /*}*/

        /*.snip1423 h3 {*/
        /*font-size: 1.3em;*/
        /*font-weight: 400;*/
        /*margin-bottom: 5px;*/
        /*text-transform: uppercase;*/
        /*}*/

        /*.snip1423 p {*/
        /*font-size: 0.9em;*/
        /*letter-spacing: 1px;*/
        /*font-weight: 300;*/
        /*}*/

        /*.snip1423 .price {*/
        /*font-weight: 500;*/
        /*font-size: 1.4em;*/
        /*line-height: 48px;*/
        /*letter-spacing: 1px;*/
        /*}*/

        /*.snip1423 .price s {*/
        /*margin-right: 5px;*/
        /*opacity: 0.5;*/
        /*font-size: 0.9em;*/
        /*}*/

        /*.snip1423 i {*/
        /*position: absolute;*/
        /*bottom: 0;*/
        /*left: 50%;*/
        /*-webkit-transform: translate(-50%, 50%);*/
        /*transform: translate(-50%, 50%);*/
        /*width: 56px;*/
        /*line-height: 56px;*/
        /*text-align: center;*/
        /*border-radius: 50%;*/
        /*background-color: #666666;*/
        /*color: #ffffff;*/
        /*font-size: 1.6em;*/
        /*border: 4px solid #ffffff;*/
        /*}*/

        /*.snip1423 a {*/
        /*position: absolute;*/
        /*top: 0;*/
        /*bottom: 0;*/
        /*left: 0;*/
        /*right: 0;*/
        /*z-index: 1;*/
        /*}*/

        /*.snip1423:hover,*/
        /*.snip1423.hover {*/
        /*-webkit-transform: translateY(-5px);*/
        /*transform: translateY(-5px);*/
        /*}*/

        /*.snip1423:hover i,*/
        /*.snip1423.hover i {*/
        /*background-color: #2980b9;*/
        /*}*/
    </style>
</head>
<body style="background: #f5f8fa;">
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'ЗабирайДаром.BY') }}
            </a>
        </div>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->


            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->

                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Войти</a></li>
                    <li><a href="{{ route('register') }}">Регистрация</a></li>
                @else
                    <li><a href="/">Главная</a></li>
                    <li><a href="{{ route('login') }}">Новости</a></li>
                    <li><a href="{{route('addAdvert')}}">Добавить Объявление</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/dashboard') }}">Личный кабинет</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}">
                                    Выйти
                                </a>


                            </li>

                        </ul>
                    </li>

                @endif
            </ul>
        </div>
    </div>
</nav>

<div class="flex-center position-ref full-height">
    <div class="container">
        @yield('content')

    </div>
</div>
</body>
</html>
