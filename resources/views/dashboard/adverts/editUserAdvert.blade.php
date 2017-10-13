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
                            <a href="{{route('addAdvert')}}" type="button" class="btn btn-sm btn-primary btn-create">Добавить
                                Объявление</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    {{ Form::open(array('route' => array('postEditAdvert','advert_id'=>$advert->id),'method' => 'post','class'=>'form-horizontal','files' => true)) }}
                    {{Form::hidden('advert_id', $advert->id)}}
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Название:</label>
                        <div class="col-lg-8">
                            {{Form::text('title',$advert->title,array('class' => 'form-control'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Категория:</label>
                        <div class="col-lg-8">
                            <div class="ui-select">
                                {!!Form::select('category_id', $categories,null,array('class' => 'form-control'))!!}
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Описание:</label>
                        <div class="col-lg-8">
                            {{Form::textarea('description',$advert->description,array('class' => 'form-control'))}}
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Страна</label>
                        <div class="col-lg-8">
                            {!!Form::select('country_id', $countries, $advert->country_id,array('class' => 'form-control','id'=>'country_id',))!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Область</label>
                        <div class="col-lg-8">
                            {!!Form::select('region_id', $regions, $advert->region_id,array('class' => 'form-control','id'=>'region_id'))!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Город</label>
                        <div class="col-lg-8">
                            {!!Form::select('city_id', $cities,$advert->city_id,array('class' => 'form-control','id'=>'city_id'))!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Адрес:</label>
                        <div class="col-lg-8">
                            <div class="ui-select">
                                {!!Form::text('address', $advert->address,array('class' => 'form-control'))!!}
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Загрузить фотографии</label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="text-center">
                                {{Form::file('images[]',['class'=>'text-center center-block well well-sm','multiple'=>"multiple"])}}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-8">
                            {{Form::submit('Сохранить',array('class'=>'btn btn-primary'))}}
                        </div>

                    </div>

                    <table class="table table-striped table-bordered table-list">
                        <thead>
                        <tr>
                            <th>Заголовок</th>
                            <th><em class="fa fa-delicious "></em></th>
                        </tr>
                        </thead>
                        <tbody>
                        <div class="container">
                            @foreach ($images as $image)
                                <tr>
                                    <td><img src="{{Storage::disk('public')->url($image->path)}}" width="100"
                                             height="100"></td>
                                    <td align="center">
                                        <a class="btn btn-danger"
                                           href="{{route('deleteAdvertImage',['image_id'=>$image->id])}}"><em
                                                    class="fa fa-trash"></em></a>
                                    </td>
                                </tr>
                            @endforeach
                        </div>

                        </tbody>
                    </table>


                    {{ Form::close() }}

                </div>
                <div class="panel-footer">
                    <div class="row">
                        <!--                        --><?php //echo $adverts->render(); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>


    @endsection
