@extends('layouts.form')

@section('title', $title.' - NotificationTemplates')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.NotificationTemplates').'<small>'.$title.'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><a href="{!! action('Modules\NotificationTemplateController@index') !!}">{{ trans('modules.NotificationTemplates') }}</a></li>
        <li><span class="active">{{ $title }}</span></li>        
    </ul>
@endsection

@section('form')
    {!! Form::group('text', 'name', 'Name', $data['name']) !!}
    {!! Form::group('text', 'subject', 'Subject', $data['subject']) !!}
    {!! Form::group('textarea', 'message', 'Message', $data['message']) !!}
    {!! Form::group('textarea', 'info', 'Info', $data['info']) !!}
    {!! Form::group('text', 'sms', 'Sms', $data['sms']) !!}
@endsection

@section('scripts')
    <script src="{!! url('vendor/jsvalidation/js/jsvalidation.js')!!}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Modules\NotificationTemplateRequest') !!}
@endsection