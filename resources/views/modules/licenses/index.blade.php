@extends('layouts.list')

@section('title', 'Licenses')

@section('page-header', '<div class="page-title"><h1>'.trans('modules.Licenses').'<small>'.trans('lucy.word.list').'</small> </h1></div>')

@section('breadcrumb')
    <ul class="breadcrumb page-breadcrumb">
        <li><a href="{!! action('DashboardController@index') !!}"> {{ trans('lucy.app.home') }}</a><i class="fa fa-circle"></i></li>
        <li><span class="active">{{ trans('modules.Licenses') }}</span></li>        
    </ul>
@endsection

@section('table-name', 'Licenses List')

@section('add-link', action('Modules\LicenseController@create'))

@section('table-id', 'licenses-table')

@section('table-th')
    <th class="center-align">Client Id</th>
    <th class="center-align">Label Id</th>
    <th class="center-align">Category Id</th>
    <th class="center-align">Supplier Id</th>
    <th class="center-align">Tag</th>
    <th class="center-align">Name</th>
    <th class="center-align">Serial</th>
    <th class="center-align">Notes</th>
@endsection

@section('ajax-datatables', action('Modules\LicenseController@datatables'))

@section('datatables-columns')
    {data: 'client_id', name: 'client_id'},
    {data: 'label_id', name: 'label_id'},
    {data: 'category_id', name: 'category_id'},
    {data: 'supplier_id', name: 'supplier_id'},
    {data: 'tag', name: 'tag'},
    {data: 'name', name: 'name'},
    {data: 'serial', name: 'serial'},
    {data: 'notes', name: 'notes'},
    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
@endsection