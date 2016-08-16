@extends('layouts.app')

@section('title', trans('lucy.app.registration').' - '.trans('lucy.app.settings'))

@section('header')
    {!! Html::style('bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') !!}
@endsection

@section('page-header', trans('lucy.app.registration').' <small>'.trans('lucy.app.settings').'</small>')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"><i class="fa fa-user-plus"></i> {{ trans('lucy.app.home') }}</a></li>
        <li><a href="#">{{ trans('lucy.app.settings') }}</a></li>
        <li class="active">{{ trans('lucy.app.registration') }}</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('lucy.app.registration') }}</h3>
                </div>
                {!! Form::horizontal($form) !!}
                    <div class="box-body">
                        @include('flash::message')
                        {!! Form::checkRadio('checkbox', 'enable', trans('lucy.form.enable-registration'), true, ['class' => 'switch', 'checked' => $data['enable'], 'data-on-text' => trans('lucy.word.yes'), 'data-off-text' => trans('lucy.word.no')]) !!}
                        {!! Form::checkRadio('checkbox', 'activate', trans('lucy.form.enable-activation'), true, ['class' => 'switch', 'checked' => $data['activate'], 'data-on-text' => trans('lucy.word.yes'), 'data-off-text' => trans('lucy.word.no')]) !!}
                        {!! Form::group('number', 'token_lifetime', trans('lucy.form.activation-code-lifetime'), $data['token_lifetime'], ['help_block' => trans('lucy.message.activation-code-lifetime-desc')]) !!}
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

            function enable_disable_activation() {
                if ($('#activate').is(':checked')) {
                    $('#token_lifetime').removeAttr('disabled');
                } else {
                    $('#token_lifetime').attr('disabled', true);
                }
            }

            enable_disable_activation();

            $('#activate').on('switchChange.bootstrapSwitch', function () {
                enable_disable_activation();
            });
        });
    </script>
@endsection