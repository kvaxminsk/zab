@extends('layouts.home')
@section('content')
    <div class="row">
        <div class="title m-b-md">
            <a href="{{route('category')}}">Вещи</a>
        </div>
        @foreach($adverts_first as $adverts)
            <div class="col-md-4">

                <figure class="snip1423">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample57.jpg" alt="sample57"/>
                    <figcaption>
                        <h3>{{$adverts->title}}</h3>
                        <p>{{str_limit($adverts->description,100)}}</p>

                    </figcaption>
                    <i class="ion-information"></i>
                    <a href="#"></a>
                </figure>

            </div>
        @endforeach
    </div>

    <div class="row">
        {{--<div class="title m-b-md">--}}
        {{--Вещи -2--}}
        {{--</div>--}}
        <div class="col-md-12">
            @foreach($adverts_second as $adverts)
                <figure class="snip1423">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample57.jpg" alt="sample57"/>
                    <figcaption>
                        <h3>{{$adverts->title}}</h3>
                        <p>{{str_limit($adverts->description,100)}}</p>

                    </figcaption>
                    <i class="ion-information"></i>
                    <a href="#"></a>
                </figure>
            @endforeach
        </div>
    </div>
    <div class="row">
        {{--<div class="title m-b-md">--}}
        {{--Вещи - 3--}}
        {{--</div>--}}
        <div class="col-md-12">
            @foreach($adverts_third as $adverts)
                <figure class="snip1423">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample57.jpg" alt="sample57"/>
                    <figcaption>
                        <h3>{{$adverts->title}}</h3>
                        <p>{{str_limit($adverts->description,100)}}</p>

                    </figcaption>
                    <i class="ion-information"></i>
                    <a href="#"></a>
                </figure>
            @endforeach
        </div>
    </div>
@endsection