@extends('layouts.list')

@section('title', 'Suppliers')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Suppliers').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.Suppliers') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'Suppliers List')

@section('add-link', action('Modules\SupplierController@create'))

@section('table-id', 'suppliers-table')

@section('table-th')
    <th class="center-align">Name</th>
    <th class="center-align">Address</th>
    <th class="center-align">Contact Name</th>
    <th class="center-align">Phone</th>
    <th class="center-align">Email</th>
    <th class="center-align">Web</th>
    <th class="center-align">Notes</th>
@endsection

@section('ajax-datatables', action('Modules\SupplierController@datatables'))

@section('datatables-columns')
    {data: 'name', name: 'name'},
    {data: 'address', name: 'address'},
    {data: 'contact_name', name: 'contact_name'},
    {data: 'phone', name: 'phone'},
    {data: 'email', name: 'email'},
    {data: 'web', name: 'web'},
    {data: 'notes', name: 'notes'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection