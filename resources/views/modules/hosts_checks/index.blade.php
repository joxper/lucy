@extends('layouts.list')

@section('title', 'HostsChecks')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.HostsChecks').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.HostsChecks') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'HostsChecks List')

@section('add-link', action('Modules\HostsCheckController@create'))

@section('table-id', 'hosts_checks-table')

@section('table-th')
    <th class="center-align">Host Id</th>
    <th class="center-align">Name</th>
    <th class="center-align">Type</th>
    <th class="center-align">Port</th>
    <th class="center-align">Monitoring</th>
    <th class="center-align">Email</th>
    <th class="center-align">Sms</th>
    <th class="center-align">Status</th>
@endsection

@section('ajax-datatables', action('Modules\HostsCheckController@datatables'))

@section('datatables-columns')
    {data: 'host_id', name: 'host_id'},
    {data: 'name', name: 'name'},
    {data: 'type', name: 'type'},
    {data: 'port', name: 'port'},
    {data: 'monitoring', name: 'monitoring'},
    {data: 'email', name: 'email'},
    {data: 'sms', name: 'sms'},
    {data: 'status', name: 'status'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection