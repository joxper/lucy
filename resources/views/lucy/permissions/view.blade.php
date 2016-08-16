@extends('layouts.view')

@section('title', trans('lucy.word.view').' - '.trans('lucy.app.permissions'))

@section('page-header', trans('lucy.app.permissions').' <small>'.trans('lucy.word.view').'</small>')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"><i class="fa fa-key"></i> {{ trans('lucy.app.home') }}</a></li>
        <li><a href="#">{{ trans('lucy.app.user-management') }}</a></li>
        <li><a href="{!! action('Lucy\PermissionController@index') !!}">{{ trans('lucy.app.permissions') }}</a></li>
        <li class="active">{{ trans('lucy.word.view') }}</li>
    </ol>
@endsection

@section('form')
    {!! Form::group('static', 'name', trans('lucy.form.name'), $data['name']) !!}
    {!! Form::group('static', 'display_name', trans('lucy.form.display_name'), $data['display_name']) !!}
    {!! Form::group('static', 'description', trans('lucy.form.description'), nl2br($data['description'])) !!}
@endsection