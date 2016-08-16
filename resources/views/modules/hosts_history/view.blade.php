@extends('layouts.view')

@section('title', trans('lucy.word.view').' - HostsHistory')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.HostsHistory').'<small>'.trans('lucy.word.view').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\HostsHistoryController@index') !!}">{{ trans('modules.HostsHistory') }}</a></li>
        <li><span class="active">{{ trans('lucy.word.view') }}</span></li>        
    </ul>

@endsection

@section('form')
    {!! Form::group('static', 'check_id', 'Check Id', $data['check_id']) !!}
    {!! Form::group('static', 'status', 'Status', $data['status']) !!}
    {!! Form::group('static', 'latency', 'Latency', $data['latency']) !!}
    {!! Form::group('static', 'timestamp', 'Timestamp', $data['timestamp']) !!}
@endsection