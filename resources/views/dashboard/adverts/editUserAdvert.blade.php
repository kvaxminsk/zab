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
                            <button type="button" class="btn btn-sm btn-primary btn-create">Добавить Объявление</button>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    {{ Form::open(array('route' => array('postEditAdvert'),'method' => 'post')) }}
                        {{Form::hidden('advert_id', $advert->id)}}
                        {{Form::text('title',$advert->title)}}
                        {{Form::text('description',$advert->description)}}
                        {{Form::submit('Click Me!')}}
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
