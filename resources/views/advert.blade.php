@extends('layouts.advert')
@section('content')

    <div class="container-fluid">
        <div class="content-wrapper">
            <div class="item-container">
                <div class="container">
                    <div class="row" style="margin-top:20px">
                        <div class="col-md-12">
                            <div class="product col-md-5 service-image-left">
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->

                                    @if(!empty($advert->images[0]))
                                        <ol class="carousel-indicators">
                                            @foreach($advert->images as $image)
                                                <li data-target="#myCarousel" data-slide-to="{{$image->id}}"
                                                    class="active"></li>
                                            @endforeach
                                        </ol>
                                    @else
                                        <ol class="carousel-indicators">
                                            <li data-target="#myCarousel" data-slide-to="1"
                                                class="active"></li>
                                        </ol>
                                @endif
                                <!-- Wrapper for slides -->
                                    <div class="carousel-inner">
                                        <?php $i = 0;?>
                                        @if(!empty($advert->images[0]))
                                            @foreach($advert->images as $image)
                                                <div class="item {{ $i == 0 ? 'active' : ''}}">
                                                    <img src="{{Storage::disk('public')->url($image->path)}}"
                                                         alt="{{$advert->title}}_{{$image->advert_id}}">
                                                </div>
                                                <?php $i++?>
                                            @endforeach
                                        @else
                                            <div class="item active">
                                                <img src="/images/site/no-image.png"
                                                     alt="no-image">
                                            </div>
                                        @endif

                                        {{--<div class="item active">--}}
                                        {{--<img src="http://www.corsair.com/Media/catalog/product/g/s/gs600_psu_sideview_blue_2.png"--}}
                                        {{--alt="Chicago">--}}
                                        {{--</div>--}}

                                        {{--<div class="item">--}}
                                        {{--<img src="http://www.corsair.com/Media/catalog/product/g/s/gs600_psu_sideview_blue_2.png"--}}
                                        {{--alt="New York">--}}
                                        {{--</div>--}}
                                    </div>

                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="product-title">{{$advert->title}}</div>
                                <div class="product-desc">{{($advert->country) ? $advert->country->title_ru :''}}{{ ($advert->region) ?  ', ' . $advert->region->title_ru :''}}{{ ($advert->city) ? ', ' . $advert->city->title_ru :''}}
                                    - {{str_limit($advert->address)}}
                                </div>
                                {{--<div class="product-rating"><i class="fa fa-star gold"></i> <i--}}
                                {{--class="fa fa-star gold"></i>--}}
                                {{--<i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i--}}
                                {{--class="fa fa-star-o"></i>--}}
                                {{--</div>--}}
                                <hr>
                                {{--<div class="product-price">$ 1234.00</div>--}}
                                <div class="product-stock">{{$advert->action_status->title}}</div>
                                <hr>

                                <div class="btn-group wishlist">
                                    <a href="{{route('userProfilePage', ['id'=>$advert->user_id])}}"
                                       class="btn btn-danger">
                                        Связаться с автором
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 left">
                            {{--<!-- Put this script tag to the <head> of your page -->--}}
                            {{--<script type="text/javascript" src="//vk.com/js/api/openapi.js?150"></script>--}}

                            {{--<script type="text/javascript">--}}
                                {{--VK.init({apiId: 6236210, onlyWidgets: true});--}}
                            {{--</script>--}}

                            {{--<!-- Put this div tag to the place, where the Like block will be -->--}}
                            {{--<div id="vk_like"></div>--}}
                            {{--<script type="text/javascript">--}}
                                {{--VK.Widgets.Like("vk_like", {type: "mini", height: 18});--}}
                            {{--</script>--}}
                            <!-- Put this script tag to the <head> of your page -->
                                <script type="text/javascript" src="https://vk.com/js/api/share.js?95" charset="windows-1251"></script>

                                <!-- Put this script tag to the place, where the Share button will be -->
                                <script type="text/javascript"><!--
                                    document.write(VK.Share.button(false,{type: "round_nocount", text: "Сохранить"}));
                                    --></script>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="col-md-12 product-info">
                        <ul id="myTab" class="nav nav-tabs nav_tabs">

                            <li class="active"><a href="#service-one" data-toggle="tab">Описание</a></li>
                            {{--<li><a href="#service-two" data-toggle="tab">PRODUCT INFO</a></li>--}}
                            {{--<li><a href="#service-three" data-toggle="tab">REVIEWS</a></li>--}}

                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade in active" id="service-one">

                                <section class="container product-info">
                                    <p>{{$advert->description}}</p>
                                </section>

                            </div>
                            {{--<div class="tab-pane fade" id="service-two">--}}

                            {{--<section class="container">--}}

                            {{--</section>--}}

                            {{--</div>--}}
                            <div class="tab-pane fade" id="service-three">

                            </div>
                        </div>
                        <hr>
                    </div>
                </div>

            </div>
        </div>
@endsection