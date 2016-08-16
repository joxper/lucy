@extends('layouts.list')

@section('title', 'HostsAdmins')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.HostsAdmins').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.HostsAdmins') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'HostsAdmins List')

@section('add-link', action('Modules\HostsAdminController@create'))

@section('table-id', 'hosts_admins-table')

@section('table-th')
    <th class="center-align">Host Id</th>
    <th class="center-align">User Id</th>
@endsection

@section('ajax-datatables', action('Modules\HostsAdminController@datatables'))

@section('datatables-columns')
    {data: 'host_id', name: 'host_id'},
    {data: 'user_id', name: 'user_id'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection