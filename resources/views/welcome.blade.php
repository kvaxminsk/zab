@extends('layouts.home')
@section('content')
    <div class="row" style="margin-left:0px">
        <div class="title m-b-md">
            <a href="{{route('category',['category_id' => 0])}}">Вещи</a>
        </div>
        @foreach($adverts_first as $advert)
            <div class="col-md-4">

                <figure class="snip1423">
                    <img src="{{ ($advert->image_latest) ? Storage::disk('public')->url($advert->image_latest->path) : 'https://www.svgimages.com/svg-image/s5/man-passportsize-silhouette-icon-256x256.png'}}" alt="sample57"/>
                    <figcaption>
                        <h3>{{$advert->title}}</h3>
                        <p>{{str_limit($advert->description,100)}}</p>
                        <p style="color:limegreen">{{$advert->action_status->title}}</p>
                    </figcaption>
                    <i class="ion-information"></i>
                    <a href="{{route('showAdvert', ['advert_id'=>$advert->id])}}"></a>
                </figure>

            </div>
        @endforeach
    </div>
    {{--<div class="row">--}}
        {{--<div class="title m-b-md">--}}
            {{--<a href="{{route('category',['category_id' => 0])}}">Вещи</a>--}}
        {{--</div>--}}
        {{--@foreach($adverts_second as $advert)--}}
            {{--<div class="col-md-4">--}}

                {{--<figure class="snip1423">--}}
                    {{--<img src="{{ ($advert->image_latest) ? Storage::disk('public')->url($advert->image_latest->path) : 'https://www.svgimages.com/svg-image/s5/man-passportsize-silhouette-icon-256x256.png'}}" alt="sample57"/>--}}
                    {{--<figcaption>--}}
                        {{--<h3>{{$advert->title}}</h3>--}}
                        {{--<p>{{str_limit($advert->description,100)}}</p>--}}

                    {{--</figcaption>--}}
                    {{--<i class="ion-information"></i>--}}
                    {{--<a href="{{route('showAdvert', ['advert_id'=>$advert->id])}}"></a>--}}
                {{--</figure>--}}

            {{--</div>--}}
        {{--@endforeach--}}
    {{--</div>--}}
    {{--<div class="row">--}}
        {{--<div class="title m-b-md">--}}
            {{--<a href="{{route('category',['category_id' => 0])}}">Вещи</a>--}}
        {{--</div>--}}
        {{--@foreach($adverts_third as $advert)--}}
            {{--<div class="col-md-4">--}}

                {{--<figure class="snip1423">--}}
                    {{--<img src="{{ ($advert->image_latest) ? Storage::disk('public')->url($advert->image_latest->path) : 'https://www.svgimages.com/svg-image/s5/man-passportsize-silhouette-icon-256x256.png'}}" alt="sample57"/>--}}
                    {{--<figcaption>--}}
                        {{--<h3>{{$advert->title}}</h3>--}}
                        {{--<p>{{str_limit($advert->description,100)}}</p>--}}

                    {{--</figcaption>--}}
                    {{--<i class="ion-information"></i>--}}
                    {{--<a href="{{route('showAdvert', ['advert_id'=>$advert->id])}}"></a>--}}
                {{--</figure>--}}

            {{--</div>--}}
        {{--@endforeach--}}
    {{--</div>--}}

@endsection