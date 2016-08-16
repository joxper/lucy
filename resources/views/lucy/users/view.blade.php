@extends('layouts.view')

@section('title', trans('lucy.word.view').' - '.trans('lucy.app.users'))

@section('page-header')
    <!-- BEGIN PAGE TITLE -->
    <div class="page-title">
        <h1>{{ trans('lucy.app.users') }}
            <small>{{ trans('lucy.word.view') }}</small>
        </h1>
    </div>
    <!-- END PAGE TITLE -->
@endsection

@section('breadcrumb')
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{!! action('DashboardController@index') !!}">{{ trans('lucy.app.home') }}</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{!! action('Lucy\UserController@index') !!}">{{ trans('lucy.app.users') }}</a>
            <i class="fa fa-circle"></i>
        </li>        
        <li>
            <span class="active">{{ trans('lucy.word.view') }}</span>
        </li>
    </ul>    
@endsection

@section('form')
    @if ($data['avatar'] && file_exists(avatar_path($data['avatar'])))
        <div class="form-group">
            <div class="col-sm-12" align="center">
                <img src="{!! link_to_avatar($data['avatar']) !!}" width="120" class="img-circle img-responsive">
            </div>
        </div>
    @endif
    {!! Form::group('static', 'email', trans('lucy.form.email'), $data['email']) !!}
    {!! Form::group('static', 'username', trans('lucy.form.username'), $data['username']) !!}
    {!! Form::group('static', 'first_name', trans('lucy.form.first_name'), $data['first_name']) !!}
    {!! Form::group('static', 'last_name', trans('lucy.form.last_name'), $data['last_name']) !!}
    {!! Form::group('static', 'role', trans('lucy.form.role'), $data['role']) !!}
@endsection