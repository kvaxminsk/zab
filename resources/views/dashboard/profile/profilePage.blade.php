@extends('layouts.dashboard')

@section('seo_title')Profile @endsection

@section('content')
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4 center-block top">
                <img style="width:150px;height:150px;"
                     src="https://www.svgimages.com/svg-image/s5/man-passportsize-silhouette-icon-256x256.png"
                     alt="stack photo" class="img">
            </div>
            <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8">
                <div class="container" style="border-bottom:1px solid black">
                    <h2>{{$user->name}}</h2>
                </div>
                <hr>
                <ul class="container details">
                    <li><p><span class="glyphicon glyphicon-earphone one" style="width:50px;"></span>+91 90000 00000</p>
                    </li>
                    <li><p><span class="glyphicon glyphicon-envelope one" style="width:50px;"></span>{{$user->email}}
                        </p></li>
                    <li><p><span class="glyphicon glyphicon-map-marker one" style="width:50px;"></span>{{$user->email}}
                        </p></li>
                    <li><p><span class="glyphicon glyphicon-new-window one" style="width:50px;"></span>{{$user->email}}
                        </p>
                </ul>
            </div>
        </div>
    </div>

@endsection