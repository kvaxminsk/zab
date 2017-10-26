@extends('layouts.home')
@section('content')
    <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-6 col-md-3 sidebar-offcanvas" id="sidebar" style="margin-top:20px">
            <div class="list-group">
                <a href="{{route('category',['category_id' => 0])}}" class="list-group-item {{($category_id) ? '' : 'active' }}">Все категории</a>
                @foreach($categories as $category)
                    <a href="{{route('category',['category_id'=> $category->id])}}"
                       class="list-group-item {{ ($category_id == $category->id) ? 'active' : '' }}">{{$category->name}}</a>
                @endforeach

            </div>
        </div>

        <div class="col-md-9">

            @foreach($adverts as $advert)
                <div class="col-md-4">
                    <figure class="snip1423_category">
                        <img style="max-height:150px;"src="{{ ($advert->image_latest) ? Storage::disk('public')->url($advert->image_latest->path) : '/images/site/no-image.png'}}" alt="sample57"/>
                        <figcaption>
                            <h3>{{$advert->title}}</h3>
                            <p>{{str_limit($advert->description,50)}}</p>
                            <p style="color:limegreen">{{$advert->action_status->title}}</p>
                        </figcaption>
                        <i class="ion-information"></i>
                        <a href="{{route('showAdvert', ['advert_id'=>$advert->id])}}"></a>
                    </figure>
                </div>
            @endforeach
            @if(!$adverts->lastPage())
                <h3>В данном разделе пока нет объявлений</h3>
            @endif
        </div>
    </div>

@endsection