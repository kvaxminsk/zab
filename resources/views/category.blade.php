@extends('layouts.home')
@section('content')
    <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-6 col-md-3 sidebar-offcanvas" id="sidebar" style="margin-top:20px">
            <div class="list-group">
                <a href="{{route('category')}}" class="list-group-item ">Все категории</a>
                @foreach($categories as $category)
                    <a href="{{route('category',['category_id'=> $category->id])}}"
                       class="list-group-item">{{$category->name}}</a>
                @endforeach

            </div>
        </div>

        <div class="col-md-9">

            @foreach($adverts as $advert)
                <div class="col-md-4">
                    <figure class="snip1423_category">
                        <img src="{{ ($advert->image_latest) ? Storage::disk('public')->url($advert->image_latest->path) : 'https://www.svgimages.com/svg-image/s5/man-passportsize-silhouette-icon-256x256.png'}}" alt="sample57"/>
                        <figcaption>
                            <h3>{{$advert->title}}</h3>
                            <p>{{str_limit($advert->description,80)}}</p>

                        </figcaption>
                        <i class="ion-information"></i>
                        <a href="#"></a>
                    </figure>
                </div>
            @endforeach
            @if(!$adverts->lastPage())
                <h3>В данном разделе пока нет объявлений</h3>
            @endif
        </div>
    </div>

    <div class="panel-footer">
        <div class="row">
            <?php echo $adverts->render(); ?>
        </div>
    </div>
@endsection