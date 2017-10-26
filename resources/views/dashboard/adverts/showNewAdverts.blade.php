@extends('layouts.dashboard')

@section('seo_title')Profile @endsection

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default panel-table">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col col-xs-6">
                            <h3 class="panel-title"></h3>
                        </div>
                        <div class="col col-xs-6 text-right">
                            <a href="{{route('addAdvert')}}" type="button" class="btn btn-sm btn-primary btn-create">Добавить Объявление</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-list">
                        <thead>
                        <tr>
                            <th>Фото</th>
                            <th>Заголовок</th>
                            <th>Описание</th>

                        </tr>
                        </thead>
                        <tbody>
                        <div class="container">
                            @foreach ($adverts as $advert)
                                <tr>
                                    <td style="width:30%"> <a href="{{route('showAdvert', ['advert_id'=>$advert->id])}}"> <img style="max-width:150px;max-height:120px"
                                               src="{{(($advert->image_latest) ? (Storage::disk('public')->url($advert->image_latest->path_resize_image)) :'/images/site/no-image.png') }}"
                                                                                                             alt="stack photo" class="img"></a></td>
                                    <td><a href="{{route('showAdvert', ['advert_id'=>$advert->id])}}">{{$advert->title}}</a></td>
                                    <td>{{str_limit($advert->description,100)}}</td>
                                </tr>
                            @endforeach
                        </div>

                        </tbody>
                    </table>
                    <?php echo $adverts->render(); ?>
                </div>

            </div>

        </div>
    </div>


@endsection
