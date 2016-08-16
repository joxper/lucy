@extends('layouts.view')

@section('title', trans('lucy.word.view').' - '.trans('lucy.app.roles'))

@section('page-header', trans('lucy.app.roles').' <small>'.trans('lucy.word.view').'</small>')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"><i class="fa fa-user"></i> {{ trans('lucy.app.home') }}</a></li>
        <li><a href="#">{{ trans('lucy.app.user-management') }}</a></li>
        <li><a href="{!! action('Lucy\RoleController@index') !!}">{{ trans('lucy.app.roles') }}</a></li>
        <li class="active">{{ trans('lucy.word.view') }}</li>
    </ol>
@endsection

@section('form')
    {!! Form::group('static', 'slug', trans('lucy.form.slug'), $data['slug']) !!}
    {!! Form::group('static', 'name', trans('lucy.form.name'), $data['name']) !!}
    @if ($data['is_admin'])
        {!! Form::group('static', 'permissions', trans('lucy.app.permissions'), trans('lucy.message.all-permissions-granted')) !!}
    @else
        {!! Form::group('static', 'permissions', trans('lucy.app.permissions'), implode(', ', $permissions)) !!}
    @endif
@endsection