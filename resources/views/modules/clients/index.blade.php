@extends('layouts.list')

@section('title', 'Clients')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Clients').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.Clients') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'Clients List')

@section('add-link', action('Modules\ClientController@create'))

@section('table-id', 'clients-table')

@section('table-th')
    <th class="center-align">ID</th>
    <th class="center-align">Name</th>
    <th class="center-align col-sm-2">Licenses</th>
    <th class="center-align col-sm-2">Assets</th>
    <th class="center-align col-sm-2">Projects</th>
@endsection

@section('ajax-datatables', action('Modules\ClientController@datatables'))

@section('datatables-columns')
    {data: 'id', id: 'id'},
    {data: 'name', name: 'name'},
    {data: 'licenses', name: 'licenses', class: 'center-align'},
    {data: 'assets', name: 'assets', class: 'center-align'},
    {data: 'projects', name: 'projects', class: 'center-align'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false},
@endsection