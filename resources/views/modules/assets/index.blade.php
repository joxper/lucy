@extends('layouts.list')

@section('title', 'Assets')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Assets').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.Assets') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'Assets List')

@section('add-link', action('Modules\AssetController@create'))

@section('table-id', 'assets-table')

@section('table-th')
    <th class="center-align">Category Id</th>
    <th class="center-align">Admin Id</th>
    <th class="center-align">Client Id</th>
    <th class="center-align">User Id</th>
    <th class="center-align">Model Id</th>
    <th class="center-align">Supplier Id</th>
    <th class="center-align">Status Id</th>
    <th class="center-align">Purchase Date</th>
    <th class="center-align">Warranty Months</th>
    <th class="center-align">Tag</th>
    <th class="center-align">Name</th>
    <th class="center-align">Serial</th>
    <th class="center-align">Notes</th>
@endsection

@section('ajax-datatables', action('Modules\AssetController@datatables'))

@section('datatables-columns')
    {data: 'category_id', name: 'category_id'},
    {data: 'admin_id', name: 'admin_id'},
    {data: 'client_id', name: 'client_id'},
    {data: 'user_id', name: 'user_id'},
    {data: 'model_id', name: 'model_id'},
    {data: 'supplier_id', name: 'supplier_id'},
    {data: 'status_id', name: 'status_id'},
    {data: 'purchase_date', name: 'purchase_date'},
    {data: 'warranty_months', name: 'warranty_months'},
    {data: 'tag', name: 'tag'},
    {data: 'name', name: 'name'},
    {data: 'serial', name: 'serial'},
    {data: 'notes', name: 'notes'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection