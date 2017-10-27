<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src=""></script>
    <title>{{ config('app.name','ЗабирайДаром.BY') }}</title>

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.typeahead.min.css') }}" rel="stylesheet">
    {{--<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet'
          type='text/css'>
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet'--}}
    {{--type='text/css'>--}}
    {{--<script src="/js/script.js"></script>--}}
    <script src="{{ asset('js/app.js') }}"></script>
    {{--<script src="{{ asset('js/bootstrap.js') }}"></script>--}}

    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/jquery.typeahead.min.js') }}"></script>
</head>
<body>
@include('template.nav')
<div class="container">
         <div class="row profile">
            @include('dashboard.blocks.leftMenu')
            <div class="col-md-9">
                <div class="profile-content">
                    @yield('content')
                </div>
            </div>
        </div>
</div>

@include('template.footer')
@include('template.yandex_metrik')

</body>
</html>
