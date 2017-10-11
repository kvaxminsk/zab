@extends('layouts.dashboard')

@section('seo_title')Profile @endsection

@section('content')
    {{ Form::open(array('route' => array('postUserEditProfile'),'method' => 'post','class'=>'form-horizontal','files' => true)) }}
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4 center-block top">
            </div>
            <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4 center-block top">
                <img style="width:150px;height:150px;"
                     src="{{Storage::disk('public')->url($image_path)}}"
                     alt="stack photo" class="img">
                <div class="text-center">
                    {{Form::file('image',['class'=>'text-center center-block well well-sm','multiple'=>"multiple"])}}
                </div>
            </div>

        </div>
        <div class="row">
            <div class="panel-body">

                {{Form::hidden('advert_id', $user->id)}}
                <div class="form-group">
                    <label class="col-lg-3 control-label">Имя:</label>
                    <div class="col-lg-8">
                        {{Form::text('name',$user->name,array('class' => 'form-control'))}}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Логин(будет отображаться везде):</label>
                    <div class="col-lg-8">
                        {{Form::text('username',$user->username,array('class' => 'form-control'))}}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Телефон</label>
                    <div class="col-lg-8">
                        {{Form::text('phone',$user->phone,array('class' => 'form-control'))}}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Страна</label>
                    <div class="col-lg-8">
                        {!!Form::select('country_id', $countries,$user->country_id,array('class' => 'form-control','id'=>'country_id',))!!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Область</label>
                    <div class="col-lg-8">
                        {!!Form::select('region_id', $regions,$user->region_id,array('class' => 'form-control','id'=>'region_id'))!!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Город</label>
                    <div class="col-lg-8">
                        {!!Form::select('city_id', $cities,$user->city_id,array('class' => 'form-control','id'=>'city_id'))!!}
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
        </div>
    </div>

@endsection
