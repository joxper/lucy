@extends('layouts.list')

@section('title', 'HostsHistory')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.HostsHistory').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.HostsHistory') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'HostsHistory List')

@section('add-link', action('Modules\HostsHistoryController@create'))

@section('table-id', 'hosts_history-table')

@section('table-th')
    <th class="center-align">Check Id</th>
    <th class="center-align">Status</th>
    <th class="center-align">Latency</th>
    <th class="center-align">Timestamp</th>
@endsection

@section('ajax-datatables', action('Modules\HostsHistoryController@datatables'))

@section('datatables-columns')
    {data: 'check_id', name: 'check_id'},
    {data: 'status', name: 'status'},
    {data: 'latency', name: 'latency'},
    {data: 'timestamp', name: 'timestamp'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection