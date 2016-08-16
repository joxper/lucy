@extends('layouts.app')

@section('title', trans('lucy.app.socialite').' - '.trans('lucy.app.settings'))

@section('header')
    {!! Html::style('bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') !!}
@endsection

@section('page-header', trans('lucy.app.socialite').' <small>'.trans('lucy.app.settings').'</small>')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"><i class="fa fa-share-alt"></i> {{ trans('lucy.app.home') }}</a></li>
        <li><a href="#">{{ trans('lucy.app.settings') }}</a></li>
        <li class="active">{{ trans('lucy.app.socialite') }}</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('flash::message')
        </div>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-facebook-official fa-fw"></i> Facebook</h3>
                </div>
                {!! Form::horizontal($formFb, $dataFb) !!}
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-sm-12" align="center">
                                {!! Form::checkbox('facebook_enable', true, $dataFb['facebook_enable'], ['id' => 'facebook_enable', 'class' => 'switch']) !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('facebook_client_id') }}">
                            <div class="col-sm-12">
                                {!! Form::text('facebook_client_id', null, ['class' => 'form-control', 'placeholder' => trans('lucy.form.client-id'), 'id' => 'facebook_client_id']) !!}
                                {!! Form::errorMsg('facebook_client_id') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('facebook_client_secret') }}">
                            <div class="col-sm-12">
                                {!! Form::password('facebook_client_secret', ['class' => 'form-control', 'placeholder' => trans('lucy.form.client-secret'), 'id' => 'facebook_client_secret']) !!}
                                {!! Form::errorMsg('facebook_client_secret') !!}
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! Form::submit(trans('lucy.word.save'), ['class' => 'btn btn-primary pull-right', 'title' => trans('lucy.word.save')]) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-google-plus-square fa-fw"></i> Google+</h3>
                </div>
                {!! Form::horizontal($formGoogle, $dataGoogle) !!}
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-sm-12" align="center">
                                {!! Form::checkbox('google_enable', true, $dataGoogle['google_enable'], ['id' => 'google_enable', 'class' => 'switch']) !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('google_client_id') }}">
                            <div class="col-sm-12">
                                {!! Form::text('google_client_id', null, ['class' => 'form-control', 'placeholder' => trans('lucy.form.client-id'), 'id' => 'google_client_id']) !!}
                                {!! Form::errorMsg('google_client_id') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('google_client_secret') }}">
                            <div class="col-sm-12">
                                {!! Form::password('google_client_secret', ['class' => 'form-control', 'placeholder' => trans('lucy.form.client-secret'), 'id' => 'google_client_secret']) !!}
                                {!! Form::errorMsg('google_client_secret') !!}
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! Form::submit(trans('lucy.word.save'), ['class' => 'btn btn-primary pull-right', 'title' => trans('lucy.word.save')]) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-twitter-square fa-fw"></i> Twitter</h3>
                </div>
                {!! Form::horizontal($formTwitter, $dataTwitter) !!}
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-sm-12" align="center">
                                {!! Form::checkbox('twitter_enable', true, $dataTwitter['twitter_enable'], ['id' => 'twitter_enable', 'class' => 'switch']) !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('twitter_client_id') }}">
                            <div class="col-sm-12">
                                {!! Form::text('twitter_client_id', null, ['class' => 'form-control', 'placeholder' => trans('lucy.form.client-id'), 'id' => 'twitter_client_id']) !!}
                                {!! Form::errorMsg('twitter_client_id') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('twitter_client_secret') }}">
                            <div class="col-sm-12">
                                {!! Form::password('twitter_client_secret', ['class' => 'form-control', 'placeholder' => trans('lucy.form.client-secret'), 'id' => 'twitter_client_secret']) !!}
                                {!! Form::errorMsg('twitter_client_secret') !!}
                            </div>
                        </div>
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

            function enable_disable(type) {
                if ($('#'+type+'_enable').is(':checked')) {
                    $('#'+type+'_client_id').removeAttr('readonly', 'readonly').attr('required', true);
                    $('#'+type+'_client_secret').removeAttr('readonly', 'readonly').attr('required', true);
                } else {
                    $('#'+type+'_client_id').attr('readonly', 'readonly').removeAttr('required');
                    $('#'+type+'_client_secret').attr('readonly', 'readonly').removeAttr('required');
                }
            }

            var socialite = ['facebook', 'google', 'twitter'];

            $.each(socialite, function (i, value) {
                enable_disable(value);

                $('#'+value+'_enable').on('switchChange.bootstrapSwitch', function () {
                    enable_disable(value);
                });
            });

        });
    </script>
@endsection