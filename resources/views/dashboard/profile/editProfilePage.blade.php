@extends('layouts.dashboard')

@section('seo_title')Profile @endsection

@section('content')
    {{ Form::open(array('route' => array('postUserEditProfile'),'method' => 'post','class'=>'form-horizontal','files' => true)) }}
    <div class="jumbotron">
        <div class="row">
            <div class="col-lg-12">
                @include('dashboard.errmsg')
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4 center-block top">
            </div>
            <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4 center-block top">
                <img style="width:150px;"
                     src="{{($image_path) ? Storage::disk('public')->url($image_path) : 'https://www.svgimages.com/svg-image/s5/man-passportsize-silhouette-icon-256x256.png'}}"
                     alt="stack photo" class="img">
                <div class="text-center">
                    {{Form::file('image',['class'=>'text-center center-block well well-sm','multiple'=>"multiple"])}}
                </div>
            </div>

        </div>

        <div class="row">
            <div class="panel-body">

                {{Form::hidden('advert_id', $user->id)}}
                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="col-lg-3 control-label">Имя<b class="star">*</b>:</label>
                    <div class="col-lg-8">
                        {{Form::text('name',$user->name,array('class' => 'form-control','required'=>'required'))}}
                        @if ($errors->has('name'))
                            <span class="error"><strong>{{ $errors->first('name') }}</strong></span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="col-lg-3 control-label">Почта:</label>
                    <div class="col-lg-8">
                        {{Form::text('email',$user->email,array('class' => 'form-control','disabled'=>'disabled'))}}
                        @if ($errors->has('email'))
                            <span class="error"><strong>{{ $errors->first('email') }}</strong></span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                    <label class="col-lg-3 control-label">Логин<b class="star">*</b>:</label>
                    <div class="col-lg-8">
                        {{Form::text('username',$user->username,array('class' => 'form-control','required'=>'required'))}}
                        @if ($errors->has('username'))
                            <span class="error"><strong>{{ $errors->first('username') }}</strong></span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                    <label class="col-lg-3 control-label">Телефон<b class="star">*</b>:</label>
                    <div class="col-lg-8">
                        {{Form::text('phone',$user->phone,array('class' => 'form-control has-error','required'=>'required'))}}
                        @if ($errors->has('phone'))
                            <span class="error"><strong>{{ $errors->first('phone') }}</strong></span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="col-lg-3 control-label">Пароль<b class="star">*</b>:</label>
                    <div class="col-lg-8">
                        {{Form::password('password',array('class' => 'form-control has-error' ))}}
                        @if ($errors->has('password'))
                            <span class="error"><strong>{{ $errors->first('password') }}</strong></span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('password_confirm') ? ' has-error' : '' }}">
                    <label class="col-lg-3 control-label">Повторите пароль<b class="star">*</b>:</label>
                    <div class="col-lg-8">
                        {{Form::password('password_confirm',array('class' => 'form-control has-error' ))}}
                        @if ($errors->has('password_confirm'))
                            <span class="error"><strong>{{ $errors->first('password_confirm') }}</strong></span>
                        @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('city_id') ? ' has-error' : '' }}">
                    <label class="col-lg-3 control-label">Город<b class="star">*</b>:</label>
                    <div class="col-lg-8">
                        <div class="typeahead__container">
                            <div class="typeahead__field">
                                <span class="typeahead__query">
                                    {!!Form::text('city_id', $city, array('class' => 'form-control js_typeahead_city_v1','id'=>'country_id','autocomplete'=>"off",'style' =>"font-size:14px;"))!!}
                                    <script>
                                        $(document).ready(function () {
                                            var url = '/json_cities';
                                            let cities;
                                            $.get(
                                                url,
                                                function (result) {
                                                    cities = result;
                                                    console.log(cities[0]);
                                                    $.typeahead({
                                                        input: '.js_typeahead_city_v1',
                                                        order: "desc",
                                                        source: {
                                                            data: cities[0]
                                                        },
                                                        callback: {
                                                            onInit: function (node) {
                                                                console.log('Typeahead Initiated on ' + node.selector);
                                                            }
                                                        }
                                                    });
                                                },
                                                "json"
                                            );
                                        });
                                    </script>
                                </span>
                            </div>
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
        </div>
    </div>

@endsection
