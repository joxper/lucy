@extends('layouts.view')

@section('title', trans('lucy.word.view').' - LogsEmail')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.LogsEmail').'<small>'.trans('lucy.word.view').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\LogsEmailController@index') !!}">{{ trans('modules.LogsEmail') }}</a></li>
        <li><span class="active">{{ trans('lucy.word.view') }}</span></li>        
    </ul>

@endsection

@section('form')
    {!! Form::group('static', 'user_id', 'User Id', $data['user_id']) !!}
    {!! Form::group('static', 'client_id', 'Client Id', $data['client_id']) !!}
    {!! Form::group('static', 'to', 'To', $data['to']) !!}
    {!! Form::group('static', 'subject', 'Subject', $data['subject']) !!}
    {!! Form::group('static', 'message', 'Message', nl2br($data['message'])) !!}
    {!! Form::group('static', 'timestamp', 'Timestamp', $data['timestamp']) !!}
@endsection