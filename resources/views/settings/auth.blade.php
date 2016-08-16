@extends('layouts.app')

@section('title', trans('lucy.app.authentication').' - '.trans('lucy.app.settings'))

@section('header')
    {!! Html::style('bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') !!}
@endsection

@section('page-header', trans('lucy.app.authentication').' <small>'.trans('lucy.app.settings').'</small>')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"><i class="fa fa-sign-in"></i> {{ trans('lucy.app.home') }}</a></li>
        <li><a href="#">{{ trans('lucy.app.settings') }}</a></li>
        <li class="active">{{ trans('lucy.app.authentication') }}</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('lucy.app.authentication') }}</h3>
                </div>
                {!! Form::horizontal($form) !!}
                    <div class="box-body">
                        @include('flash::message')
                        <fieldset>
                            <legend>{{ trans('lucy.app.general') }}</legend>
                            {!! Form::checkRadio('checkbox', 'remember_me', trans('lucy.form.allow-remember-me'), true, ['class' => 'switch', 'checked' => $data['remember_me'], 'data-on-text' => trans('lucy.word.yes'), 'data-off-text' => trans('lucy.word.no')]) !!}
                            {!! Form::checkRadio('checkbox', 'forgot_password', trans('lucy.auth.forgot-password'), true, ['class' => 'switch', 'checked' => $data['forgot_password'], 'data-on-text' => 'YES', 'data-off-text' => 'NO']) !!}
                            {!! Form::group('number', 'token_lifetime', trans('lucy.form.reset-token-lifetime'), $data['token_lifetime'], ['help_block' => 'Number of minutes that the reset token should be considered valid.']) !!}
                        </fieldset>
                        <fieldset>
                            <legend>{{ trans('lucy.app.throttling') }}</legend>
                            {!! Form::checkRadio('checkbox', 'throttle', trans('lucy.form.throttle'), true, ['class' => 'switch', 'checked' => $data['throttle'], 'data-on-text' => trans('lucy.word.yes'), 'data-off-text' => trans('lucy.word.no')]) !!}
                            {!! Form::group('number', 'throttle_interval', trans('lucy.form.throttling-interval'), $data['throttle_interval'], ['help_block' => trans('lucy.message.throttling-interval-desc')]) !!}
                            {!! Form::group('number', 'throttle_thresholds', trans('lucy.form.throttling-threshold'), $data['throttle_thresholds'], ['help_block' => 'Number of failed login attempts.']) !!}
                        </fieldset>
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
@endsection