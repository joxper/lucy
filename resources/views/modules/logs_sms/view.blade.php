@extends('layouts.view')

@section('title', trans('lucy.word.view').' - LogsSms')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.LogsSms').'<small>'.trans('lucy.word.view').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\LogsSmController@index') !!}">{{ trans('modules.LogsSms') }}</a></li>
        <li><span class="active">{{ trans('lucy.word.view') }}</span></li>        
    </ul>

@endsection

@section('form')
    {!! Form::group('static', 'user_id', 'User Id', $data['user_id']) !!}
    {!! Form::group('static', 'client_id', 'Client Id', $data['client_id']) !!}
    {!! Form::group('static', 'mobile', 'Mobile', $data['mobile']) !!}
    {!! Form::group('static', 'sms', 'Sms', $data['sms']) !!}
    {!! Form::group('static', 'timestamp', 'Timestamp', $data['timestamp']) !!}
@endsection