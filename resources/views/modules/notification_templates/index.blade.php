@extends('layouts.list')

@section('title', 'NotificationTemplates')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.NotificationTemplates').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.NotificationTemplates') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'NotificationTemplates List')

@section('add-link', action('Modules\NotificationTemplateController@create'))

@section('table-id', 'notification_templates-table')

@section('table-th')
    <th class="center-align">Name</th>
    <th class="center-align">Subject</th>
    <th class="center-align">Message</th>
    <th class="center-align">Info</th>
    <th class="center-align">Sms</th>
@endsection

@section('ajax-datatables', action('Modules\NotificationTemplateController@datatables'))

@section('datatables-columns')
    {data: 'name', name: 'name'},
    {data: 'subject', name: 'subject'},
    {data: 'message', name: 'message'},
    {data: 'info', name: 'info'},
    {data: 'sms', name: 'sms'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection