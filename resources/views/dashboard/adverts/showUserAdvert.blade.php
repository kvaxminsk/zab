@extends('layouts.dashboard')

@section('seo_title')Profile @endsection

@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet'
          type='text/css'>

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
                            <th>Заголовок</th>
                            <th>Статус</th>
                            <th><em class="fa fa-cog"></em></th>
                        </tr>
                        </thead>
                        <tbody>
                        <div class="container">
                            @foreach ($adverts as $advert)
                                <tr>
                                    <td>{{$advert->title}}</td>
                                    <td>{{$advert->status->title}}</td>
                                    <td align="center">
                                        <a class="btn btn-default"
                                           href="{{route('editAdvert',['id'=>$advert->id])}}"><em
                                                    class="fa fa-pencil"></em></a>
                                        <a class="btn btn-danger" href="{{route('deleteAdvert',['id'=>$advert->id])}}"><em
                                                    class="fa fa-trash"></em></a>
                                    </td>
                                </tr>
                            @endforeach;
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
