@extends('layouts.list')

@section('title', 'Credentials')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Credentials').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.Credentials') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'Credentials List')

@section('add-link', action('Modules\CredentialController@create'))

@section('table-id', 'credentials-table')

@section('table-th')
    <th class="center-align">Client Id</th>
    <th class="center-align">Asset Id</th>
    <th class="center-align">Type</th>
    <th class="center-align">Username</th>
    <th class="center-align">Password</th>
@endsection

@section('ajax-datatables', action('Modules\CredentialController@datatables'))

@section('datatables-columns')
    {data: 'client_id', name: 'client_id'},
    {data: 'asset_id', name: 'asset_id'},
    {data: 'type', name: 'type'},
    {data: 'username', name: 'username'},
    {data: 'password', name: 'password'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection