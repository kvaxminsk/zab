@extends('layouts.dashboard')

@section('seo_title')Profile @endsection

@section('content')


    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default panel-table">
                <div class="panel-heading">
                    <div class="row">

                        <div class="col col-xs-6 text-left">
                            <a href="{{route('addAdvert')}}" type="button" class="btn btn-sm btn-primary btn-create">Добавить Объявление</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive panel-body" style="max-width: 100%; overflow: auto;">
                    <table class="table table-striped table-bordered table-list">
                        <thead>
                        <tr>
                            <th>Заголовок</th>
                            <th>Статус</th>
                            <th>Состояние объявления</th>
                            <th><em class="fa fa-cog"></em></th>
                        </tr>
                        </thead>
                        <tbody>
                        <div class="container">
                            @foreach ($adverts as $advert)
                                <tr>
                                    <td>{{$advert->title}}</td>
                                    <td>{{$advert->status->title}}</td>
                                    <td>{{$advert->action_status->title}}</td>
                                    <td align="center">
                                        <a class="btn btn-default"
                                           href="{{route('editAdvert',['id'=>$advert->id])}}"><em
                                                    class="fa fa-pencil"></em></a>
                                        <a class="btn btn-danger" href="{{route('deleteAdvert',['id'=>$advert->id])}}"><em
                                                    class="fa fa-trash"></em></a>
                                    </td>
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
