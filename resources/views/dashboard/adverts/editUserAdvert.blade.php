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
                    {{ Form::open(array('route' => array('postEditAdvert','advert_id'=>$advert->id),'method' => 'post','class'=>'form-horizontal','files' => true)) }}
                    {{Form::hidden('advert_id', $advert->id)}}
                    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                        <label class="col-lg-3 control-label">Название:</label>
                        <div class="col-lg-8">
                            {{Form::text('title',$advert->title,array('class' => 'form-control'))}}
                            @if ($errors->has('title'))
                                <span class="error"><strong>{{ $errors->first('title') }}</strong></span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
                        <label class="col-lg-3 control-label">Категория:</label>
                        <div class="col-lg-8">
                            <div class="ui-select">
                                {!!Form::select('category_id', $categories,$advert->category_id,array('class' => 'form-control'))!!}
                                @if ($errors->has('category_id'))
                                    <span class="error"><strong>{{ $errors->first('category_id') }}</strong></span>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('adverts_active_status_id') ? ' has-error' : '' }}">
                        <label class="col-lg-3 control-label">Статус:</label>
                        <div class="col-lg-8">
                            <div class="ui-select">
                                {!!Form::select('adverts_active_status_id', $adverts_active_statuses,$advert->adverts_active_status_id,array('class' => 'form-control'))!!}
                                @if ($errors->has('adverts_active_status_id'))
                                    <span class="error"><strong>{{ $errors->first('adverts_active_status_id') }}</strong></span>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                        <label class="col-lg-3 control-label">Описание:</label>
                        <div class="col-lg-8">
                            {{Form::textarea('description',$advert->description,array('class' => 'form-control'))}}
                            @if ($errors->has('description'))
                                <span class="error"><strong>{{ $errors->first('description') }}</strong></span>
                            @endif
                        </div>

                    </div>
                    <div class="form-group {{ $errors->has('city_id') ? ' has-error' : '' }}">
                        <label class="col-lg-3 control-label">Город:</label>
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

                    <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                        <label class="col-lg-3 control-label">Адрес:</label>
                        <div class="col-lg-8">
                            <div class="ui-select">
                                {!!Form::text('address', $advert->address,array('class' => 'form-control'))!!}
                                @if ($errors->has('address'))
                                    <span class="error"><strong>{{ $errors->first('address') }}</strong></span>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('images[]') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Загрузить фотографии</label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="text-center">
                                {{Form::file('images[]',['class'=>'text-center center-block well well-sm','multiple'=>"multiple"])}}
                                @if ($errors->has('images[]'))
                                    <span class="error"><strong>{{ $errors->first('images[]') }}</strong></span>
                                @endif
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

            </div>

        </div>
    </div>


    @endsection
