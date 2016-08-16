@extends('layouts.list')

@section('title', 'ClientsAdmins')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.ClientsAdmins').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.ClientsAdmins') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'ClientsAdmins List')

@section('add-link', action('Modules\ClientsAdminController@create'))

@section('table-id', 'clients_admins-table')

@section('table-th')
    <th class="center-align">User Id</th>
    <th class="center-align">Client Id</th>
@endsection

@section('ajax-datatables', action('Modules\ClientsAdminController@datatables'))

@section('datatables-columns')
    {data: 'user_id', name: 'user_id'},
    {data: 'client_id', name: 'client_id'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection