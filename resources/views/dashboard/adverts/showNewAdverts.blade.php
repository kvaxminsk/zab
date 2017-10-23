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
                            <th>Категория</th>

                        </tr>
                        </thead>
                        <tbody>
                        <div class="container">
                            @foreach ($adverts as $advert)
                                <tr>
                                    <td>  <img style="width:150px;"
                                               src="{{Storage::disk('public')->url($advert->image_latest->path)}}"
                                               alt="stack photo" class="img"></td>
                                    <td>{{$advert->title}}</td>
                                    <td>{{$advert->category->name}}</td>
                                </tr>
                            @endforeach
                        </div>

                        </tbody>
                    </table>

                </div>
                <div class="panel-footer">
                    <div class="row">
                        <?php echo $adverts->render(); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
