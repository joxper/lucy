@extends('layouts.list')

@section('title', 'Devices')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Devices').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.Devices') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'Devices List')

@section('add-link', action('Modules\DeviceController@create'))

@section('table-id', 'devices-table')

@section('table-th')
    <th class="center-align">Name</th>
    <th class="center-align">Category Id</th>
    <th class="center-align">Client Id</th>
    <th class="center-align">User Id</th>
    <th class="center-align">Admin Id</th>
    <th class="center-align">Supplier Id</th>
    <th class="center-align">Label Id</th>
    <th class="center-align">Purchase Date</th>
    <th class="center-align">Warranty Months</th>
    <th class="center-align">Tag</th>
    <th class="center-align">Serial</th>
    <th class="center-align">Notes</th>
@endsection

@section('ajax-datatables', action('Modules\DeviceController@datatables'))

@section('datatables-columns')
    {data: 'name', name: 'name'},
    {data: 'category_id', name: 'category_id'},
    {data: 'client_id', name: 'client_id'},
    {data: 'user_id', name: 'user_id'},
    {data: 'admin_id', name: 'admin_id'},
    {data: 'supplier_id', name: 'supplier_id'},
    {data: 'label_id', name: 'label_id'},
    {data: 'purchase_date', name: 'purchase_date'},
    {data: 'warranty_months', name: 'warranty_months'},
    {data: 'tag', name: 'tag'},
    {data: 'serial', name: 'serial'},
    {data: 'notes', name: 'notes'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection