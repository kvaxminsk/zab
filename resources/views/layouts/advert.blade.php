<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$advert->title}}</title>
    <meta name="description" content="{{$advert->description}}">
    <!-- jQuery library -->
    <!-- meta tag for social -->
    <meta property="og:locale" content="ru_RU"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="{{$advert->title}}"/>
    <meta property="og:description" content="{{$advert->description}}"/>
    <meta property="og:image" content="{{ ($advert->image_latest) ? Storage::disk('public')->url($advert->image_latest->path_resize_image) : '/images/site/no-image.png'}}"/>
    <meta property="og:url" content="{{route('showAdvert', ['advert_id'=>$advert->id])}}"/>
    <meta property="og:site_name" content="ЗабирайДаром.BY"/>
    <!-- meta tag for social -->



    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}"></script>

    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
</head>
<body style="background: #f5f8fa;">
@include('template.nav')

<div class="flex-center position-ref full-height">
    <div class="container">
        @yield('content')
    </div>
</div>
@include('template.footer')
@include('template.yandex_metrik')
@include('template.vk_online')
</body>
</html>
