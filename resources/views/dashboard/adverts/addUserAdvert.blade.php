@extends('layouts.dashboard')

@section('seo_title')Profile @endsection

@section('content')
    <script>

    </script>

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
                        <div class="col col-xs-6 text-left">
                            <a href="{{route('addAdvert')}}" type="button" class="btn btn-sm btn-primary btn-create">Добавить
                                Объявление</a>
                        </div>
                    </div>

                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="col-lg-12 control-label" style="color:orangered">Отдавать за "вкусняшки"
                                нельзя! Даром - значит за спасибо!!!</label>
                        </div>

                    </div>
                    {{ Form::open(array('route' => array('postAddAdvert'),'method' => 'post','class'=>'form-horizontal','files' => true)) }}
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label class="col-lg-3 control-label">Название<b class="star">*</b>:</label>
                        <div class="col-lg-8">
                            {{Form::text('title','',array('class' => 'form-control','required'=>'required' ))}}
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
                    <div class="form-group {{ $errors->has('adverts_active_statuses') ? ' has-error' : '' }}">
                        <label class="col-lg-3 control-label">Статус:</label>
                        <div class="col-lg-8">
                            <div class="ui-select">
                                {!!Form::select('adverts_active_status_id', $adverts_active_statuses,null,array('class' => 'form-control'))!!}
                                @if ($errors->has('category_id'))
                                    <span class="error"><strong>{{ $errors->first('category_id') }}</strong></span>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label class="col-lg-3 control-label">Описание<b class="star">*</b>:</label>
                        <div class="col-lg-8">
                            {{Form::textarea('description',null,array('class' => 'form-control','required'=>'required' ))}}
                            @if ($errors->has('description'))
                                <span class="error"><strong>{{ $errors->first('description') }}</strong></span>
                            @endif
                        </div>

                    </div>
                    <div class="form-group{{ $errors->has('city_id') ? ' has-error' : '' }}">
                        <label class="col-lg-3 control-label">Город<b class="star">*</b>:</label>
                        <div class="col-lg-8">
                            <div class="ui-select" style=>
                                <div class="typeahead__container">
                                    <div class="typeahead__field">
                                        <span class="typeahead__query">
                                            {!!Form::text('city_id', $city, array('class' => 'form-control js_typeahead_city_v1','id'=>'country_id','autocomplete'=>"off",'style' =>"font-size:14px;",'required'=>'required' ))!!}
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
                                                            //                                                        console.log(result);
                                                            //                                                        console.log(JSON.parse('[1, 5, "false"]'));
                                                        },
                                                        "json"
                                                    );
                                                    //                                                countries();
                                                    //                                                function countries(countries = []) {

                                                    //                                                }
                                                });
                                            </script>
                                        </span>
                                    </div>
                                </div>
                            </div>
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
                                {{Form::file('images[]',['class'=>'text-center center-block ','multiple'=>"multiple",'min'=>'1', 'max'=>'10'])}}

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
    </div>
    @endsection
