@extends('layouts.app')

@section('title', trans('lucy.app.profile-settings'))

@section('page-header', trans('lucy.app.profile-settings'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"><i class="fa fa-user"></i> Home</a></li>
        <li class="active">{{ trans('lucy.app.profile-settings') }}</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li{!! ('profile' == session('tab_active')) ? ' class="active"' : ''  !!}><a href="#tab-profile" data-toggle="tab">{{ trans('lucy.app.profile') }}</a></li>
                    <li{!! ('password' == session('tab_active')) ? ' class="active"' : ''  !!}><a href="#tab-password" data-toggle="tab">{{ trans('lucy.form.password') }}</a></li>
                </ul>
                <div class="tab-content">
                    @include('flash::message')
                    <div class="tab-pane{!! ('profile' == session('tab_active')) ? ' active' : ''  !!}" id="tab-profile">
                        {!! Form::horizontal($formProfile, $user) !!}
                            @if ($user['avatar'] && file_exists(avatar_path($user['avatar'])))
                                <div class="form-group">
                                    <div class="col-sm-12" align="center">
                                        <img src="{!! link_to_avatar($user['avatar']) !!}" width="120" class="img-circle img-responsive">
                                    </div>
                                </div>
                            @endif
                            {!! Form::group('file', 'avatar', trans('lucy.form.avatar')) !!}
                            {!! Form::group('text', 'email', trans('lucy.form.email'), $user['email']) !!}
                            {!! Form::group('text', 'username', trans('lucy.form.username'), $user['username']) !!}
                            {!! Form::group('text', 'first_name', trans('lucy.form.first_name'), $user['first_name']) !!}
                            {!! Form::group('text', 'last_name', trans('lucy.form.last_name'), $user['last_name']) !!}
                            {!! Form::group('select', 'skin', trans('lucy.form.layout-skin'), $user['skin'], ['options' => $skins]) !!}
                            <div class="form-group">
                                <div class="col-sm-12">
                                    {!! Form::submit(trans('lucy.word.save'), ['class' => 'btn btn-primary pull-right']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="tab-pane{!! ('password' == session('tab_active')) ? ' active' : ''  !!}" id="tab-password">
                        {!! Form::horizontal($formPassword) !!}
                            <div class="form-group{{ Form::hasError('old_password') }}">
                                {!! Form::label('old_password', trans('lucy.form.old-password'), ['class' => 'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::password('old_password', ['class' => 'form-control']) !!}
                                    {!! Form::errorMsg('old_password') !!}
                                </div>
                            </div>
                            <div class="form-group{{ Form::hasError('password') }}">
                                {!! Form::label('password', trans('lucy.form.new-password'), ['class' => 'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::password('password', ['class' => 'form-control']) !!}
                                    {!! Form::errorMsg('password') !!}
                                </div>
                            </div>
                            <div class="form-group{{ Form::hasError('password_confirmation') }}">
                                {!! Form::label('password_confirmation', trans('lucy.form.confirm-password'), ['class' => 'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                                    {!! Form::errorMsg('password_confirmation') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    {!! Form::submit(trans('lucy.word.save'), ['class' => 'btn btn-primary pull-right']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! $profileValidator->selector('#form-profile') !!}
    {!! $passwordValidator->selector('#form-password') !!}
@endsection