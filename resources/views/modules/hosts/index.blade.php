@extends('layouts.list')

@section('title', 'Hosts')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Hosts').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.Hosts') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'Hosts List')

@section('add-link', action('Modules\HostController@create'))

@section('table-id', 'hosts-table')

@section('table-th')
    <th class="center-align">Client Id</th>
    <th class="center-align">Name</th>
    <th class="center-align">Address</th>
    <th class="center-align">Status</th>
@endsection

@section('ajax-datatables', action('Modules\HostController@datatables'))

@section('datatables-columns')
    {data: 'client_id', name: 'client_id'},
    {data: 'name', name: 'name'},
    {data: 'address', name: 'address'},
    {data: 'status', name: 'status'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection