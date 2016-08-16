@extends('layouts.view')

@section('title', trans('lucy.word.view').' - HostsChecks')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.HostsChecks').'<small>'.trans('lucy.word.view').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\HostsCheckController@index') !!}">{{ trans('modules.HostsChecks') }}</a></li>
        <li><span class="active">{{ trans('lucy.word.view') }}</span></li>        
    </ul>

@endsection

@section('form')
    {!! Form::group('static', 'host_id', 'Host Id', $data['host_id']) !!}
    {!! Form::group('static', 'name', 'Name', $data['name']) !!}
    {!! Form::group('static', 'type', 'Type', $data['type']) !!}
    {!! Form::group('static', 'port', 'Port', $data['port']) !!}
    {!! Form::group('static', 'monitoring', 'Monitoring', $data['monitoring']) !!}
    {!! Form::group('static', 'email', 'Email', $data['email']) !!}
    {!! Form::group('static', 'sms', 'Sms', $data['sms']) !!}
    {!! Form::group('static', 'status', 'Status', $data['status']) !!}
@endsection