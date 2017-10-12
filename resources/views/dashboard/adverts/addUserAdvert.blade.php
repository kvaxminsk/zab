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
                    {{ Form::open(array('route' => array('postAddAdvert'),'method' => 'post','class'=>'form-horizontal','files' => true)) }}
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Название:</label>
                        <div class="col-lg-8">
                            {{Form::text('title','',array('class' => 'form-control'))}}
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
                        <label class="col-lg-3 control-label">Адрес:</label>
                        <div class="col-lg-8">
                            <div class="ui-select">
                                {!!Form::text('address', null,array('class' => 'form-control'))!!}
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Описание:</label>
                        <div class="col-lg-8">
                            {{Form::textarea('description',null,array('class' => 'form-control'))}}
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Загрузить фотографии</label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="text-center">
                                {{--{{Form::file('images',['class'])}}--}}
                                <input type="file" class="text-center center-block well well-sm" name="images[]"
                                       multiple>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-8">
                            {{Form::submit('Сохранить',array('class'=>'btn btn-primary'))}}
                        </div>

                    </div>

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
