@extends('layouts.view')

@section('title', trans('lucy.word.view').' - NotificationTemplates')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.NotificationTemplates').'<small>'.trans('lucy.word.view').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\NotificationTemplateController@index') !!}">{{ trans('modules.NotificationTemplates') }}</a></li>
        <li><span class="active">{{ trans('lucy.word.view') }}</span></li>        
    </ul>

@endsection

@section('form')
    {!! Form::group('static', 'name', 'Name', $data['name']) !!}
    {!! Form::group('static', 'subject', 'Subject', $data['subject']) !!}
    {!! Form::group('static', 'message', 'Message', nl2br($data['message'])) !!}
    {!! Form::group('static', 'info', 'Info', nl2br($data['info'])) !!}
    {!! Form::group('static', 'sms', 'Sms', $data['sms']) !!}
@endsection