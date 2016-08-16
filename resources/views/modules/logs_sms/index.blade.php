@extends('layouts.list')

@section('title', 'LogsSms')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.LogsSms').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.LogsSms') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'LogsSms List')

@section('add-link', action('Modules\LogsSmController@create'))

@section('table-id', 'logs_sms-table')

@section('table-th')
    <th class="center-align">User Id</th>
    <th class="center-align">Client Id</th>
    <th class="center-align">Mobile</th>
    <th class="center-align">Sms</th>
    <th class="center-align">Timestamp</th>
@endsection

@section('ajax-datatables', action('Modules\LogsSmController@datatables'))

@section('datatables-columns')
    {data: 'user_id', name: 'user_id'},
    {data: 'client_id', name: 'client_id'},
    {data: 'mobile', name: 'mobile'},
    {data: 'sms', name: 'sms'},
    {data: 'timestamp', name: 'timestamp'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection