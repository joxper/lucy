@extends('layouts.list')

@section('title', 'LogsEmail')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.LogsEmail').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.LogsEmail') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'LogsEmail List')

@section('add-link', action('Modules\LogsEmailController@create'))

@section('table-id', 'logs_email-table')

@section('table-th')
    <th class="center-align">User Id</th>
    <th class="center-align">Client Id</th>
    <th class="center-align">To</th>
    <th class="center-align">Subject</th>
    <th class="center-align">Message</th>
    <th class="center-align">Timestamp</th>
@endsection

@section('ajax-datatables', action('Modules\LogsEmailController@datatables'))

@section('datatables-columns')
    {data: 'user_id', name: 'user_id'},
    {data: 'client_id', name: 'client_id'},
    {data: 'to', name: 'to'},
    {data: 'subject', name: 'subject'},
    {data: 'message', name: 'message'},
    {data: 'timestamp', name: 'timestamp'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection