@extends('layouts.dashboard')

@section('seo_title')Profile @endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('dashboard.errmsg')
        </div>
    </div>
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
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label class="col-lg-3 control-label">Название:</label>
                        <div class="col-lg-8">
                            {{Form::text('title','',array('class' => 'form-control'))}}
                            @if ($errors->has('title'))
                                <span class="error"><strong>{{ $errors->first('title') }}</strong></span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                        <label class="col-lg-3 control-label">Категория:</label>
                        <div class="col-lg-8">
                            <div class="ui-select">
                                {!!Form::select('category_id', $categories,null,array('class' => 'form-control'))!!}
                                @if ($errors->has('category_id'))
                                    <span class="error"><strong>{{ $errors->first('category_id') }}</strong></span>
                                @endif
                            </div>

                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label class="col-lg-3 control-label">Описание:</label>
                        <div class="col-lg-8">
                            {{Form::textarea('description',null,array('class' => 'form-control'))}}
                            @if ($errors->has('description'))
                                <span class="error"><strong>{{ $errors->first('description') }}</strong></span>
                            @endif
                        </div>

                    </div>

                    <div class="form-group{{ $errors->has('country_id') ? ' has-error' : '' }}">
                        <label class="col-lg-3 control-label">Страна</label>
                        <div class="col-lg-8">
                            {!!Form::select('country_id', $countries,$user->country_id,array('class' => 'form-control','id'=>'country_id',))!!}
                            @if ($errors->has('country_id'))
                                <span class="error"><strong>{{ $errors->first('country_id') }}</strong></span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('region_id') ? ' has-error' : '' }}">
                        <label class="col-lg-3 control-label">Область</label>
                        <div class="col-lg-8">
                            {!!Form::select('region_id', $regions, $user->region_id,array('class' => 'form-control','id'=>'region_id'))!!}
                            @if ($errors->has('region_id'))
                                <span class="error"><strong>{{ $errors->first('region_id') }}</strong></span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('city_id') ? ' has-error' : '' }}">
                        <label class="col-lg-3 control-label">Город</label>
                        <div class="col-lg-8">
                            {!!Form::select('city_id', $cities,$user->city_id,array('class' => 'form-control','id'=>'city_id'))!!}
                            @if ($errors->has('city_id'))
                                <span class="error"><strong>{{ $errors->first('city_id') }}</strong></span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                        <label class="col-lg-3 control-label">Адрес:</label>
                        <div class="col-lg-8">
                            <div class="ui-select">
                                {!!Form::text('address', null,array('class' => 'form-control'))!!}
                                @if ($errors->has('address'))
                                    <span class="error"><strong>{{ $errors->first('address') }}</strong></span>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Загрузить фотографии</label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="text-center">
                                {{--{{Form::file('images',['class'])}}--}}
                                {{--<input type="file" class="text-center center-block well well-sm" name="images[]"--}}
                                       {{--multiple>--}}
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
