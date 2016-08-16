@extends('layouts.view')

@section('title', trans('lucy.word.view').' - HostsAdmins')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.HostsAdmins').'<small>'.trans('lucy.word.view').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\HostsAdminController@index') !!}">{{ trans('modules.HostsAdmins') }}</a></li>
        <li><span class="active">{{ trans('lucy.word.view') }}</span></li>        
    </ul>

@endsection

@section('form')
    {!! Form::group('static', 'host_id', 'Host Id', $data['host_id']) !!}
    {!! Form::group('static', 'user_id', 'User Id', $data['user_id']) !!}
@endsection