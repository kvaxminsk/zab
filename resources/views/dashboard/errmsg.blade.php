@if ($errors->any())
    <div class="form_message">
        <div class="alert alert-danger alert-block">
            <strong>Error</strong>
            <span class="alert-text">
                @foreach($errors->all() as $e)
                    {!! $e !!} <br>
                @endforeach
                {{--@if ($message = $errors->first(0, ':message'))--}}
                    {{--{!! $message !!}--}}
                {{--@else--}}
                    {{--Please check the form filling--}}
                {{--@endif--}}
            </span>
        </div>
    </div>

@endif

@if ($message = Session::get('success'))
    <div class="form_message">
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert"><i class="fa fa-minus-square">-</i></button>
            <strong>Успех!</strong> <span class="alert-text">{!! $message !!}</span>
        </div>
    </div>
@endif
@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert"><i class="fa fa-minus-square">-</i></button>
        <strong>Ошибка!!</strong> <span class="alert-text">{!! $message !!}</span>
    </div>
@endif
