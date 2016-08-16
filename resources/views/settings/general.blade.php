@extends('layouts.app')

@section('title', trans('lucy.app.general').' - '.trans('lucy.app.settings'))

@section('header')
    {!! Html::style('bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') !!}
@endsection

@section('page-header', trans('lucy.app.general').' <small>'.trans('lucy.app.settings').'</small>')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"><i class="fa fa-desktop"></i> {{ trans('lucy.app.home') }}</a></li>
        <li><a href="#">{{ trans('lucy.app.settings') }}</a></li>
        <li class="active">{{ trans('lucy.app.general') }}</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('lucy.app.general') }}</h3>
                </div>
                {!! Form::horizontal($form) !!}
                    <div class="box-body">
                        @include('flash::message')
                        {!! Form::group('select', 'env', trans('lucy.form.app-env'), $env, ['options' => $dropdownEnv]) !!}
                        {!! Form::checkRadio('checkbox', 'debug', trans('lucy.form.app-debug'), true, ['class' => 'switch', 'checked' => $debug, 'data-on-text' => trans('lucy.word.yes'), 'data-off-text' => trans('lucy.word.no')]) !!}
                        {!! Form::group('text', 'url', trans('lucy.form.app-url'), $url) !!}
                        {!! Form::group('select', 'timezone', trans('lucy.form.app-tz'), $timezone, ['options' => $dropdownTz]) !!}
                        {!! Form::group('text', 'name', trans('lucy.form.app-name'), $name) !!}
                        {!! Form::group('text', 'initial', trans('lucy.form.app-initial'), $initial) !!}
                        {!! Form::group('text', 'desc', trans('lucy.form.app-desc'), $desc) !!}
                    </div>
                    <div class="box-footer">
                        {!! Form::submit(trans('lucy.word.save'), ['class' => 'btn btn-primary pull-right', 'title' => trans('lucy.word.save')]) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js') !!}

    <script>
        $(document).ready(function () {
            $('.switch').bootstrapSwitch({
                size: 'small'
            });
        });
    </script>

    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Settings\GeneralRequest') !!}
@endsection